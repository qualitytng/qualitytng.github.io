---
title: "Measurements in ASR"
excerpt: "Các phương pháp đo lường trong ASR"
toc: true

header:
  #teaser: /assets/images/my-personal-website-th.jpg
  overlay_image:  /assets/images/my-personal-website-th.jpg
  overlay_color: "#000"
  overlay_filter: 0.6
  caption: " "

categories:
  - ASR
  - Deep_Learning

tags:
  - Deep-Learning
  - ASR
  - WER
  - graph
  - Measurements
---

# Các bài liên quan đến cách đo lường

## ASR: Phương pháp WER:

- [eesen: end-to-end speech recognition using deep rnn models and wfst-based decoding](https://arxiv.org/pdf/1507.08240v3.pdf):
    - Bài này diễn tả về RNN và WFST, phương pháp cũ, dùng GMM-HMM chuyển sang CTC.
    - Code tại đây: [github](https://github.com/srvk/eesen), code kết hợp python-C++, cũng là low-lever.
    - Hình: Không có hình
    - Bảng: Eesen RNN so sánh với LM khác nhau.

- [Optimizing expected word error rate via sampling for speech recognition](https://static.googleusercontent.com/media/research.google.com/en//pubs/archive/d48e71155cb8013dd0d9d43414225225ee832ea5.pdf): Bài này in WER theo step training.

- [Minimum word error training of long short-term memory recurrent neural network language models for speech recognition](https://ieeexplore.ieee.org/document/7472827), [PDF](https://sci-hub.tw/10.1109/ICASSP.2016.7472827)
    - Bài này train lấy WER làm thước đo để tính thay vì loss hay acc,
    - không có hình nào,
    - 4 models so sánh với nhau.
    - 2 DBs
    - 2 tables, so sánh kết quả của DEV & TEST

- [Word Error Rate Estimation for Speech Recognition: e-WER](http://aclweb.org/anthology/P18-2004)
    - estimate e-WER, không hiểu lắm ý tác giả muốn làm là gì.
    - Code dùng keras: tại [github](https://github.com/qcri/e-wer): code có đầy đủ cả training model và các hàm plot.

- [State-of-the-art speech recognition with sequence-to-sequence models, 2018](https://arxiv.org/pdf/1712.01769.pdf)
    - Bài này hay, dùng Attention-based encoder-decoder architectures
    - 1 model gốc + thêm 5 thành phần => 6 models, so sánh kết quả với nhau.
    - Không có hình.
    - Data: ∼12,500 hour training set consisting of 15 million English utterances.

- [Improved training of end-to-end attention models for speech recognition,2018](https://arxiv.org/pdf/1805.03294v1.pdf)
    - Code:[espnet](https://github.com/espnet/espnet), this [code](https://github.com/rwth-i6/returnn) and [this code](https://github.com/rwth-i6/returnn-experiments/tree/master/2018-asr-attention/librispeech/full-setup-attention) also in the paper.
    - Cảm nhận về code: được nhiều người quan tâm, nhưng code rất low-lever, sẽ mất khá nhiều time để tìm hiểu và cho nó chạy được.

## KWS

- [Keyword spotting in historical handwritten documents based on graph matching, 2018](https://sci-hub.tw/10.1016/j.patcog.2018.04.001), DOI: https://doi.org/10.1016/j.patcog.2018.04.001
    - Bài này là KWS cho text, tìm hiểu cách họ biểu diễn kết quả.
    - table: đặc tính DB, Kết quả so sánh 2 phương pháp đánh giá khác nhau (Graph-based vs. template-based KWS), so sánh parametters
    - figures: precision  & recall
    - Tất cả các trích dẫn đều có link

- [Small-footprint keyword spotting using deep neural network and connectionist temporal classifier, 2017](https://arxiv.org/pdf/1709.03665.pdf)
    - Có 4 hình, hình quan trọng là  `Fig. 2. The performance of the Deep-KWS vs. CTC-KWS` và `Fig. 3. The optimized performance of adaptive training`, hai hình này tính False Reject Rate & False Alarm Rate.
    - So sánh 5 model với nhau bởi `DNN (số lớp khác nhau ) + CTC`.
    - Khái niệm (trang 4):
    >   Receiver Operating Characteristic (ROC)
        curves, where the false reject rate(that is, a key phrase is
        present but a negative decision is given) is on the vertical axis
        and the false alarm rate (that is, a key-phrase is not present but
        a positive decision is made) is on X-axis.  Lower curves are
        better in performance, depending on the tradeoff between the
        two indices. The ROC is obtained by sweeping through confidence thresholds and averaging the curves vertically over all
        keywords in test.





















...
