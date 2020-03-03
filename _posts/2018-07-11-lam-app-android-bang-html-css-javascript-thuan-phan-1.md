---
layout: post
title: Làm app android chỉ bằng html, css và javascript thuần, phần một - Viết code javascript
category: Chuyện lập trình
thumbnail: mobile-app.png
cover: lam-app-android.jpg
tags:
 - lap-trinh-javascript
related_posts:
 - title: 
   link: https://laptrinhcuocsong.com/series-nghich-ngom-lap-trinh-phan-mem-paint-ve-tren-web-html5-javascript.html
 - title: 
   link: https://laptrinhcuocsong.com/series-nghich-ngom-lam-game-hung-trung.html
 - title: 
   link: https://laptrinhcuocsong.com/toi-da-hack-cho-tot-nhu-the-nao.html
 - title:
   link: https://laptrinhcuocsong.com/tai-sao-dan-lap-trinh-thuong-fa.html
related_videos:
  -
    title: Sự khác nhau giữa lập trình viên miền Bắc và miền Nam
    id: N0K7ZONRs6w
  -
    title: Đang code mà buồn tè thì làm thế nào?
    id: 5lkDOd8PKHc
  -
    title: Lập trình viên và chuyện tình yêu, chia tay, buồn, cắm đầu vào code
    id: Nbu8tBtef3c
  -
    title: Live stream - backend hay frontend dễ kiếm việc làm hơn
    id: VvPv9kiB01A
---

Trong sê-ri này mình sẽ cùng các bạn xây dựng một ứng dụng android chỉ bằng html, css và javascript. Hiện nay có rất nhiều framework javascript giúp phát triển ứng dụng nhanh hơn, tuy nhiên chúng ta sẽ cùng trở lại với javascript thuần, bắt đầu từ con số không cho đến khi app của chúng ta lên Play Store.

Đây không phải là cách tốt nhất để tạo app android, tuy nhiên với tinh thần học là chính, sê-ri này sẽ giúp bạn để hiểu thêm một chút, rằng javascript tương tác với DOM document như thế nào? Hybird app là gì? Đưa app lên Play Store như thế nào?

Toàn bộ sê-ri này gồm 4 phần:

> Phần 1: Viết code javascript<br>
Phần 2: Mông má lại cho đẹp bằng css<br>
Phần 3: App signing và build thành apk<br>
Phần 4: Đưa app lên Google Play

Link github toàn bộ code ở đây:

[https://github.com/buivannguyen/girl-puzzle-android-app](https://github.com/buivannguyen/girl-puzzle-android-app)

## Phân tích một chút

Đây là một app giải trí, khi mở app lên sẽ có một cái hình gái xinh, bấm vào cái hình gái xinh nó sẽ cho một câu hỏi, trả lời đúng thì được qua hình gái xinh tiếp theo, sai phải chơi lại từ đầu. Điểm vui của trò này là người chơi không biết sẽ bị hỏi câu gì, nó sẽ hỏi những câu trời ơi đất hỡi như là "Cô gái có hình xăm trên chân trái hay chân phải".

Các màn hình cơ bản:

![Android app](images/android-app.png)

Hình trên là màn hình dạng thô, chưa thêm thắt trang trí cho các bạn dễ hiểu, ở phần 2 chúng ta mới mông má lại cho đẹp sau.

Chúng ta sẽ có các màn hình như sau:

- Màn hình start, để tải dữ liệu câu hỏi và link ảnh về, khi tải xong sẽ hiện nút "Bắt đầu"
- Màn hình hiện hình ảnh cho họ xem, hiện số level ở trên đầu
- Màn hình hiện câu hỏi với 4 đáp án
- Màn hình game over, thông báo trả lời sai, nút cho chơi lại

Theo phân tích trên, chúng ta viết file index.html như sau:

```javascript
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="scene" id="welcome">
    <div>
        <div>
            <p id="loadingText">Đang tải...</p>
            <button id="startButton">Bắt đầu</button>
        </div>
    </div>
</div>

<div class="scene" id="image">
    <p>Level: <span id="level">1</span></p>
    <div>
        <div id="imageWrapper"></div>
        <div id="imageLoading">Đang tải...</div>
    </div>
</div>

<div class="scene" id="question">
    <div>
        <div>
            <p id="questionText"></p>
            <button id="answerButton0"></button>
            <button id="answerButton1"></button>
            <button id="answerButton2"></button>
            <button id="answerButton3"></button>
        </div>
    </div>
</div>

<div class="scene" id="gameOver">
    <div>
        <div>
            <p>Rất tiếc bạn đã trả lời sai</p>
            <button id="restartGame">Chơi lại</button>
        </div>
    </div>
</div>

</body>
<script type="text/javascript" src="app.js"></script>
</html>
```
Như các bạn thấy, mình tạo ra 4 div tương ứng với 4 màn hình với class là `.scene` để dễ dàng ẩn hiện khi cần thiết. Ban đầu tất cả các div này ẩn (`display: none`) sau đó muốn hiện màn hình nào thì đặt nó là `display: block`

## Object chính của ứng dụng

Object chính của ứng dụng, gọi cho sang mồm là `Application super object` là object chứa toàn bộ mọi thứ, từ UI, network, data... tóm lại là tất tần tật những cái gì có trong ứng dụng, các thành phần này tương tác với nhau. Kiểu như bạn làm một website, thì ban đầu bạn tạo là 1 class tên là `website` sau đó trong class này bạn định nghĩa thêm các class con như form, menu, header, footer... để dễ dàng quản lý.

Hãy xem qua code này và đừng vội hiểu gì cả, mình sẽ giải thích ở bên dưới.

```javascript
var app = function(){
    this.ui       = new ui(this);
    this.network  = new network(this);
    this.data     = [];
    this.level    = 0;
    this.question = null;
    
    var self      = this;

    // Boot all first time load
    this.boot = function(){
        this.ui.setScene('welcome');
        this.ui.listenEvents();
        this.loadData();
    }

    // Load data from api
    this.loadData = function(){
        this.network.get(
            DATA_URL,
            function(data){
                self.data = data;
                self.ui.hide('loadingText');
                self.ui.show('startButton');
            },
            function(error){
                alert(error);
            }
        )
    }

    // Preload an image
    this.loadImage = function(){
        this.ui.show('imageLoading');
        this.network.loadImage(
            self.data[self.level].image,
            function(image){
                self.ui.hide('imageLoading');
                self.ui.showImage(image);
            }
        );
    }

    // Start new game
    this.start = function(){
        this.ui.setScene('image');
        this.loadImage();
    }

    // Pick a ramdom question then show it
    this.pickAndShowQuestion = function(){
        // Pick a random question
        var questions = this.data[this.level].questions;
        var random    = Math.round(Math.random() * (questions.length - 1));
        this.question = questions[random];

        // Show it
        this.ui.showQuestion(this.question);
        this.ui.setScene('question');
    }

    // Check for answer on button click
    this.checkAnswer = function(answer){
        if (answer == this.question.correct){
            this.nextLevel();
        }
        else {
            this.ui.setScene('gameOver');
        }
    }

    // Next level
    this.nextLevel = function(){
        if (this.level == this.data.length - 1){
            alert("Bạn đã chiến thắng");
            this.restart();
            return;
        }

        this.level++;
        this.ui.updateLevelNumber();
        this.ui.setScene('image');
        this.loadImage();
    }

    // Restart game
    this.restart = function(){
        this.level = 0;
        this.ui.updateLevelNumber();
        this.ui.setScene('welcome');
    }
    
}
```

Theo code trên, ban đầu mình tạo ra một object tên là `app`, đừng hỏi mình tại sao lại là `var app = function()` nhé, vì trong javascript mọi thứ đều là object cả. Hiện tại ES6 đã hõ trợ từ khóa `Class` thì phải, nhưng sợ không tương thích nên chưa dám dùng :))

Trong object này, mình tạo ra các object như `ui` để quản lý giao diện, `network` để làm các việc liên quan đến lấy dữ liệu, các object này mình sẽ giải thích cụ tỉ ở bên dưới.

Ngoài ra mình còn định nghĩa `data` là một mảng để chứa data đã lấy về, data là một file json bạn có thể xem [ở đây](https://github.com/buivannguyen/girl-puzzle-android-app/blob/master/sample_data.json). `level` là một con số để lưu level hiện tại, `question` để chứa câu hỏi hiện tại, để thuận tiện cho thao tác :)

**Giải thích ý nghĩa các method**:

- **Boot**: Đặt tên là `boot` cho nó có vẻ chuyên nghiệp tí, đây là hàm chạy lần đầu tiên, hiện màn hình welcome, load data và listen các event cho các nút.
- **loadData**: Đây là hàm lấy dữ liệu từ server về, nó sử dụng object network, sẽ giải thích sau. Sau khi lấy được dữ liệu thì ẩn dòng chữ "Loading data" và hiện nút start lên.
- **loadImage**: Tải trước một hình ảnh trước khi hiện nó lên, nó sẽ tải hình ảnh ở level hiện tại.
- **pickAndShowQuestion**: Chọn ngẫu nhiên một câu hỏi và hiện nó lên màn hình câu hỏi.
- **checkAnswer**: Hàm này được gọi khi người dùng bấm trả lời câu hỏi, nó sẽ kiểm tra xem trả lời đúng chưa, nếu đúng, thì nhảy qua level tiếp theo, nếu sai thì hiện màn hình game over.
- **nextLevel**: Tải hình ảnh và nhảy sang level tiếp theo.
- **restart**: Hàm này được gọi khi người dùng bấm nút "chơi lại", reset level rồi chuyển về màn hình welcome.

## Network object

Đây là object đảm nhiệm vai trò lấy dữ liệu từ server về, tải trước ảnh để hiện chữ "loading image". Đây chỉ là request ajax thuần mà các bạn đã biết. Sau khi tải dữ liệu xong, nó gọi hàm `successCallback`

```javascript
var network = function(app){

    // Get data, this function use very-basic ajax request
    this.get = function(url, successCallback, errorCallback){
        var request = new XMLHttpRequest();
        request.open('GET', url);
        request.onload = function() {
            if (request.status === 200) {
                successCallback(JSON.parse(request.responseText));
            }
            else {
                errorCallback(request.status);
            }
        };
        request.send();
    }

    // Preload an image
    this.loadImage = function(imageUrl, successCallback, errorCallback){
        var img = new Image();
        img.onload = function(){
            successCallback(img);
        }
        img.onerror = function(){
            errorCallback();
        }
        img.src = imageUrl;
    }
}
```

## UI Object

UI (user interface) là object đảm nhiện vai trò quản lý giao diện, nôm na là ẩn cái này hiện cái kia, đồng thời nhận event khi người dùng nhấn nút này nút nọ, rồi gọi hàm ở object chính. Có lẽ không cần giải thích nhiều vì ở đây mình chỉ sử dụng các hàm javascript tương tác với DOM cơ bản thôi.

```javascript
var ui = function(app){

    this.app = app;

    var self = this;

    // Get HTML element by id
    this.getElement = function(elementId){
        return document.getElementById(elementId);
    }

    // Show an element
    this.show = function(elementId){
        this.getElement(elementId).style.display = 'block';
    }

    // Hide an element
    this.hide = function(elementId){
        this.getElement(elementId).style.display = 'none';
    }

    // Set current scene
    this.setScene = function(sceneName){
        // Get all elements have class .scene
        var elements = document.getElementsByClassName('scene');
        // Then hide them
        [].forEach.call( elements, function(element) {
            element.style.display = 'none';
        });
        // Then show element has id screenName
        this.show(sceneName);
    }

    // Show image
    this.showImage = function(image){
        this.getElement('imageWrapper').innerHTML = '';
        this.getElement('imageWrapper').appendChild(image);
    }

    // Update level number on top of the app
    this.updateLevelNumber = function(){
        this.getElement('level').innerHTML = this.app.level + 1;
    }

    // Show question text and 4 answer buttons
    this.showQuestion = function(question){
        this.getElement('questionText').innerHTML = question.question;
        this.getElement('answerButton0').innerHTML = question.answers[0];   
        this.getElement('answerButton1').innerHTML = question.answers[1];   
        this.getElement('answerButton2').innerHTML = question.answers[2];   
        this.getElement('answerButton3').innerHTML = question.answers[3];
    }

    // Listen click events
    this.listenEvents = function(){
        // Click start button
        this.getElement('startButton').addEventListener('click', function(){
            self.app.start();
        });

        // Click #image div
        this.getElement('image').addEventListener('click', function(){
            self.app.pickAndShowQuestion();
        });

        // Click restartGame button
        this.getElement('restartGame').addEventListener('click', function(){
            self.app.restart();
        });

        // Listen click event for 4 answer buttons
        this.getElement('answerButton0').addEventListener('click', function(){
            self.app.checkAnswer(0);
        });
        this.getElement('answerButton1').addEventListener('click', function(){
            self.app.checkAnswer(1);
        });
        this.getElement('answerButton2').addEventListener('click', function(){
            self.app.checkAnswer(2);
        });
        this.getElement('answerButton3').addEventListener('click', function(){
            self.app.checkAnswer(3);
        });
    }
}
```

## Now we are ready to go

Sau khi đã định nghĩa hết các object, mình tạo luôn object chính ở cuối file `app.js` trong sự kiện onload của window và gọi ngay hàm `boot`

```javascript
/*
 * Now we are ready to go
 */
window.onload = function(){
    var girlPuzzle = new app();
    girlPuzzle.boot();
}
```

## Kết bài

Không cần sử dụng kỹ thuật gì cao siêu, cũng không dùng framework nào cả, thông qua bài viết này bạn đã tự mình học được các kiến thức javascript căn bản, hiểu được javascript làm việc với các thành phần DOM như thế nào. Trong phần sau, mình sẽ cùng các bạn mông má lại cái app này cho đẹp hơn, chứ đưa lên app store xấu như thế này người ta cười cho.

Bạn có thể xem và tải code ở link github trên về chạy thử để hiểu rõ hơn. Hẹn gặp các bạn ở phần 2.