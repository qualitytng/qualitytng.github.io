---
title: "Word Error Rate (WER) and Word Recognition Rate (WRR) with Python"
excerpt: " "
toc: true

date: 25-12-2018

header:
  teaser: /assets/images/DL1.jpg
  overlay_image: /assets/images/DL1.jpg
  overlay_color: "#000"
  overlay_filter: 0.6

sidebar:
  - title: "Papers"
    image: /assets/images/bio-photo.jpg
    image_alt: "logo"
    text: "Nghiên cứu khoa học"
  - title: ""
    text: ""

categories:
  - WER

tags:
  - Deep-Learning
  - ASR
  - WER
  - Papers
---


# Word Error Rate (WER) and Word Recognition Rate (WRR) with Python
"WAcc(WRR) and WER as defined above are, the de facto standard most often used in speech recognition."

WER has been developed and is used to check a speech recognition's engine accuracy. It works by calculating the distance between the engine's reults - called the hypothesis - and the real text - called the reference.

The distance function is based on the [Levenshtein Distance](https://web.archive.org/web/20171215025927/http://en.wikipedia.org/wiki/Levenshtein_distance) (for finding the edit distance between words). The WER, like the Levenshtein distance, defines the distance by the amount of minimum operations that has to been done for getting from the reference to the hypothesis. Unlike the Levenshtein distance, however, the operations are on words and not on individual characters. The possible operations are:

Deletion: A word was deleted. A word was deleted from the reference.

Insertion: A word was added. An aligned word from the hypothesis was added.

Substitution: A word was substituted. A word from the reference was substituted with an aligned word from the hypothesis.

Also unlike the Levenshtein distance, the WER counts the deletions, insertion and substitutions done, instead of just summing up the penalties. To do that, we'll have to first create the table for the Levenshtein distance algorithm, and then backtrace in it through the shortest route to [0,0], counting the operations on the way.

Then, we'll use the formula to calculate the WER:


From this, the code is self explanatory:

```python
def wer(ref, hyp ,debug=False):
    r = ref.split()
    h = hyp.split()
    #costs will holds the costs, like in the Levenshtein distance algorithm
    costs = [[0 for inner in range(len(h)+1)] for outer in range(len(r)+1)]
    # backtrace will hold the operations we've done.
    # so we could later backtrace, like the WER algorithm requires us to.
    backtrace = [[0 for inner in range(len(h)+1)] for outer in range(len(r)+1)]

    OP_OK = 0
    OP_SUB = 1
    OP_INS = 2
    OP_DEL = 3

    DEL_PENALTY=1 # Tact
    INS_PENALTY=1 # Tact
    SUB_PENALTY=1 # Tact
    # First column represents the case where we achieve zero
    # hypothesis words by deleting all reference words.
    for i in range(1, len(r)+1):
        costs[i][0] = DEL_PENALTY*i
        backtrace[i][0] = OP_DEL

    # First row represents the case where we achieve the hypothesis
    # by inserting all hypothesis words into a zero-length reference.
    for j in range(1, len(h) + 1):
        costs[0][j] = INS_PENALTY * j
        backtrace[0][j] = OP_INS

    # computation
    for i in range(1, len(r)+1):
        for j in range(1, len(h)+1):
            if r[i-1] == h[j-1]:
                costs[i][j] = costs[i-1][j-1]
                backtrace[i][j] = OP_OK
            else:
                substitutionCost = costs[i-1][j-1] + SUB_PENALTY # penalty is always 1
                insertionCost    = costs[i][j-1] + INS_PENALTY   # penalty is always 1
                deletionCost     = costs[i-1][j] + DEL_PENALTY   # penalty is always 1

                costs[i][j] = min(substitutionCost, insertionCost, deletionCost)
                if costs[i][j] == substitutionCost:
                    backtrace[i][j] = OP_SUB
                elif costs[i][j] == insertionCost:
                    backtrace[i][j] = OP_INS
                else:
                    backtrace[i][j] = OP_DEL

    # back trace though the best route:
    i = len(r)
    j = len(h)
    numSub = 0
    numDel = 0
    numIns = 0
    numCor = 0
    if debug:
        print("OP\tREF\tHYP")
        lines = []
    while i > 0 or j > 0:
        if backtrace[i][j] == OP_OK:
            numCor += 1
            i-=1
            j-=1
            if debug:
                lines.append("OK\t" + r[i]+"\t"+h[j])
        elif backtrace[i][j] == OP_SUB:
            numSub +=1
            i-=1
            j-=1
            if debug:
                lines.append("SUB\t" + r[i]+"\t"+h[j])
        elif backtrace[i][j] == OP_INS:
            numIns += 1
            j-=1
            if debug:
                lines.append("INS\t" + "****" + "\t" + h[j])
        elif backtrace[i][j] == OP_DEL:
            numDel += 1
            i-=1
            if debug:
                lines.append("DEL\t" + r[i]+"\t"+"****")
    if debug:
        lines = reversed(lines)
        for line in lines:
            print(line)
        print("Ncor " + str(numCor))
        print("Nsub " + str(numSub))
        print("Ndel " + str(numDel))
        print("Nins " + str(numIns))
    return (numSub + numDel + numIns) / (float) (len(r))
    wer_result = round( (numSub + numDel + numIns) / (float) (len(r)), 3)
    return {'WER':wer_result, 'Cor':numCor, 'Sub':numSub, 'Ins':numIns, 'Del':numDel}
# Run:
ref='Tuan anh mot ha chin'
hyp='tuan anh mot hai ba bon chin'
wer(ref, hyp ,debug=True)

OP	REF	     HYP
SUB	Tuan     tuan
OK	anh	     anh
OK	mot	     mot
INS	****	 hai
INS	****	 ba
SUB	ha	     bon
OK	chin	 chin
Ncor 3
Nsub 2
Ndel 0
Nins 2
0.8
```
### Ref

- https://martin-thoma.com/word-error-rate-calculation/

# WER
Bản gốc [tại đây](https://martin-thoma.com/word-error-rate-calculation/)

```python
#!/usr/bin/env python

def wer(r, h):
    """
    Calculation of WER with Levenshtein distance.

    Works only for iterables up to 254 elements (uint8).
    O(nm) time ans space complexity.

    Parameters
    ----------
    r : list
    h : list

    Returns
    -------
    int

    Examples
    --------
    >>> wer("who is there".split(), "is there".split())
    1
    >>> wer("who is there".split(), "".split())
    3
    >>> wer("".split(), "who is there".split())
    3
    """
    # initialisation
    import numpy
    d = numpy.zeros((len(r)+1)*(len(h)+1), dtype=numpy.uint8)
    d = d.reshape((len(r)+1, len(h)+1))
    for i in range(len(r)+1):
        for j in range(len(h)+1):
            if i == 0:
                d[0][j] = j
            elif j == 0:
                d[i][0] = i

    # computation
    for i in range(1, len(r)+1):
        for j in range(1, len(h)+1):
            if r[i-1] == h[j-1]:
                d[i][j] = d[i-1][j-1]
            else:
                substitution = d[i-1][j-1] + 1
                insertion    = d[i][j-1] + 1
                deletion     = d[i-1][j] + 1
                d[i][j] = min(substitution, insertion, deletion)

    return d[len(r)][len(h)]

if __name__ == "__main__":
    import doctest
    doctest.testmod()
```
