---
title: ASR measurements
excerpt: Cách đo lường khi làm việc với ASR
toc: true

header:
  teaser: /assets/images/blog/toptal-th.jpg
  overlay_image: /assets/images/blog/end-to-end-performance.png
  overlay_color: "#000"
  overlay_filter: 0.6
  caption: " "

author_profile: false
related: false

categories:
  - Deep-Learning

tags:
  - Deep-Learning
  - ASR
  - WER

---

# Liệt kê các phương pháp đo lường kết quả trong các bài báo quốc tế về ASR (Automatic Speech Recognition).

<div style="text-align:center"><img src ="/assets/images/blog/end-to-end-performance.png" style="max-height: 300px;max-width: 500px;"/></div>

---

## Danh sách:

|Tên bài | Phương pháp|Model liên quan| năm & link| Ảnh       |
|--------|------------|-----------    |-----------|-----------|
| SMALL-FOOTPRINT KEYWORD SPOTTING USING DEEP NEURAL NETWORK AND CONNECTIONIST TEMPORAL CLASSIFIER | False Reject Rate - False Alarm Rate | Baseline Deep-KWS (3x128), DNN(3x128)+CTC, DNN(3x256)+CTC, DNN(4x256)+CTC, DNN(6x512)+CTC | [12 Sep 2017](https://arxiv.org/pdf/1709.03665.pdf)  |    <img style="max-width: 250px;max-height: 200px;" src="https://raw.githubusercontent.com/holianh/holianh.github.io/master/_posts/img_posts/2018-12-19-14-00-56.png">  |
| END-TO-END MODELS WITH AUDITORY ATTENTION IN MULTI-CHANNEL KEYWORD SPOTTING | False Reject Rate - False Alarm Rate | Baseline, Attention, Attention_map, Transfer, Transfer_map, Tran_Multi_map | [3 Nov 2018](https://arxiv.org/pdf/1811.00350v2.pdf)  |    <img style="max-width: 250px;max-height: 200px;" src="https://raw.githubusercontent.com/holianh/holianh.github.io/master/_posts/img_posts/2018-12-19-14-03-45.png"/> |
| HIERARCHICAL NEURAL NETWORK ARCHITECTURE IN KEYWORD SPOTTING | Recall rate – Miswake/hour | HNN1/2/3 (allbn, 1bn), baseline | [6 Nov 2018](https://arxiv.org/pdf/1811.02320.pdf)  |    <img style="max-width: 250px;max-height: 200px;" src="https://raw.githubusercontent.com/holianh/holianh.github.io/master/_posts/img_posts/2018-12-19-14-10-47.png"/> |
| EFFICIENT KEYWORD SPOTTING USING DILATED CONVOLUTIONS AND GATING | False Reject Rate - False Alarm Rate per hour | CNN, LSTM, WaveNet | [19 Nov 2018](https://arxiv.org/pdf/1811.07684.pdf)  |    <img style="max-width: 250px;max-height: 200px;" src="https://raw.githubusercontent.com/holianh/holianh.github.io/master/_posts/img_posts/2018-12-19-14-13-21.png"/> |
| QUERY-BY-EXAMPLE KEYWORD SPOTTING USING LONG SHORT-TERM MEMORY NETWORKS | False Reject Rate - False Alarm Rate | Phone DNN/LSTM+DTW, LSTM Feat Extrator | [2015](https://clsp.jhu.edu/~guoguo/papers/icassp2015_myhotword.pdf)  |    <img style="max-width: 250px;max-height: 200px;" src="https://raw.githubusercontent.com/holianh/holianh.github.io/master/_posts/img_posts/2018-12-19-14-16-42.png"/> |
| Wav2Letter: an End-to-End ConvNet-based Speech Recognition System | LER- train set size | MFCC, MFCC+AUG, POW, POU+AUG | [13 Sep 2016](https://arxiv.org/pdf/1609.03193v2.pdf)  |    <img style="max-width: 250px;max-height: 200px;" src="https://raw.githubusercontent.com/holianh/holianh.github.io/master/_posts/img_posts/2018-12-19-14-20-45.png"/> |
| minimum-word-error-rate-training-for-attention-based-sequence-to-sequence-models | WER-Training Eporchs | Lamda=0/0.01/0.1, Bi-LAS, +MWER, Uni-LAS, MWER, CD-phone (CE + sMBR) | [Dec 05, 2017](https://www.groundai.com/project/minimum-word-error-rate-training-for-attention-based-sequence-to-sequence-models/)  |    <img style="max-width: 250px;max-height: 200px;" src="https://raw.githubusercontent.com/holianh/holianh.github.io/master/_posts/img_posts/wer_lambda_nbest.png.750x0_q75_crop.jpg"/> |
|EESEN: END-TO-END SPEECH RECOGNITION USING DEEP RNN MODELS AND WFST-BASED DECODING|WER, #params~8.5M|Eesen RNN,Hybrid HMM/DNN dùng LM: Lexicon, trigram |[2015](https://sci-hub.tw/10.1109/ASRU.2015.7404790)||
|Low latency acoustic modeling using temporal convolution and LSTMs|WER|TDNN-D, LFR-LSTM, LFR-BLSTM, MFR-LSTM, MFR-BLSTM |[2018](https://sci-hub.tw/10.1109/lsp.2017.2723507)| Stacking LSTMs over time-delay neural network (TDNN)|
|Long Short-Term Memory Recurrent Neural Network Architectures for Large Scale Acoustic Modeling|||[interspeech_2014](https://www.isca-speech.org/archive/archive_papers/interspeech_2014/i14_0338.pdf)|Baseline model|
||||||
||||||
||||||
||||||
||||||
||||||
||||||










.
.
.
