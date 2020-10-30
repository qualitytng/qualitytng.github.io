---
layout: post
title: Cùng nhau tạo restful API đơn giản với php
thumbnail: restful-api.jpg
category: Chuyện lập trình
tags:
 - lap-trinh-php
 - nhung-dieu-co-ban-ve-lap-trinh
 - cach-hoc-lap-trinh-cho-nguoi-chua-biet-gi
related_posts:
 - title: 
   link: https://laptrinhcuocsong.com/tao-va-xuat-ban-jquery-plugin-trong-30-phut.html
 - title: 
   link: https://laptrinhcuocsong.com/lam-he-thong-tu-dong-tao-sub-domain-bang-php.html
 - title: 
   link: https://laptrinhcuocsong.com/series-nghich-ngom-lap-trinh-phan-mem-paint-ve-tren-web-html5-javascript.html
 - title: 
   link: https://laptrinhcuocsong.com/tong-hop-nhung-cong-cu-can-thiet-cho-web-developer.html
related_videos:
  -
    title: Cảm giác khi thử lập trình pascal, trở về tuổi thơ dữ dội sau 10 năm 
    id: 0UO9UKjVQ68
  -
    title: Gái nhờ cài win thì làm gì?
    id: qzGHoksg4N4
  -
    title: Thực trạng học lập trình của các thanh niên hiện nay =))
    id: ABxYyQiYYW4
  -
    title: Code trên giấy? 
    id: VT1uT9A7ELE
---
Như các bạn đã biết, các API (Application Programming Interfaces) được sử dụng rất phổ biến, trong thế giới kết nối như bây giờ, một ứng dụng không thể đứng độc lập mà cần phải kết nối với các ứng dụng khác. Có thể nói một sản phẩm nếu không có các API giống như máy tính không được kết nối Internet vậy. Trong bài viết này,  mình sẽ cùng các bạn tạo một restful API đơn giản với php.

Một restful api phải làm 3 việc sau:

- Nhận các request: hàm _input()
- Xử lý các request: hàm _process_api()
- Trả về response: hàm response()

Chúng ta sẽ dần xây dựng cả 3 hàm trên, đầu tiên mình sẽ viết ra cấu trúc căn bản của class restful_api với các hàm và thuộc tính cơ bản:

```javascript
class restful_api {
    protected $method   = '';
    protected $endpoint = '';
    protected $params   = array();
    protected $file     = null;


    public function __construct(){
        $this->_input();
        $this->_process_api();
    }

    private function _input(){
        // code của hàm _input
    }

    private function _process_api(){
        // code của hàm _process_api
    }
}
```

## Bước 1: Nhận dữ liệu.

Ví dụ: Một request lấy thông tin người dùng được gửi lên như sau:

```
GET http://api.domain.com/user/<user_id>/<some_other_param>
```

Thì endpoint ở đây là user và params là mảng các tham số đằng sau. Chúng ta sẽ thực hiện lấy enpoint và các params trong hàm _input()

```javascript
class restful_api {

    ...

    private function _input(){
        $this->params = explode('/', trim($_SERVER['PATH_INFO'],'/'));
        $this->endpoint = array_shift($this->params);

        // Lấy method của request
        $method         = $_SERVER['REQUEST_METHOD'];
        $allow_method   = array('GET', 'POST', 'PUT', 'DELETE');

        if (in_array($method, $allow_method)){
            $this->method = $method;
        }

        // Nhận thêm dữ liệu tương ứng theo từng loại method
        switch ($this->method) {
            case 'POST':
                $this->params = $_POST;
            break;

            case 'GET':
                // Không cần nhận, bởi params đã được lấy từ url
            break;

            case 'PUT':
                $this->file    = file_get_contents("php://input");
            break;

            case 'DELETE':
                // Không cần nhận, bởi params đã được lấy từ url
            break;

            default:
                $this->response(500, "Invalid Method");
            break;
        }
    }

    ...

}
```

## Bước 2: Xử lý request

Khi đã có được endpoint và các dữ liệu cần thiết, chúng ta sẽ gọi hàm endpoint tương ứng:

```javascript
class restful_api {

    ...

    private function _process_api(){        
        if (method_exists($this, $this->endpoint)){
            $this->{$this->endpoint}();
        }
        else {
            $this->response(500, "Unknown endpoint");
        }
    }

    ...

}
```

Như các bạn thấy đoạn $this->{$this->endpoint}(); có nghĩa là nếu enpoint là user thì nó sẽ gọi hàm $this->user() luôn, hàm này sẽ được viết ở class con của class restful_api (Tí nữa đến phần cách dùng mình sẽ giải thích thêm, tạm thời thế đã :stuck_out_tongue_winking_eye:).

## Bước 3: Trả về response:

Cách trả về hết sức đơn giản, chỉ cần dùng hàm header của php để trả về http response theo mã http tương ứng.

```javascript
class restful_api {

    ...

    /**
     * Trả dữ liệu về client
     * @param: $status_code: mã http trả về
     * @param: $data: dữ liệu trả về
     */
    protected function response($status_code, $data = NULL){
        header($this->_build_http_header_string($status_code));
        header("Content-Type: application/json");
        echo json_encode($data);
        die();
    }
    
    /**
     * Tạo chuỗi http header
     * @param: $status_code: mã http
     * @return: Chuỗi http header, ví dụ: HTTP/1.1 404 Not Found
     */
    private function _build_http_header_string($status_code){
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error'
        );
        return "HTTP/1.1 " . $status_code . " " . $status[$status_code];
    }

    ...

}
```

Đến đây chúng ta đã hoàn thành, đây là toàn bộ code class restful_api của chúng ta.

```javascript
class restful_api {
    /**
     * Property: $method
     * Method được gọi, GET POST PUT hoặc DELETE
     */
    protected $method = '';
    /**
     * Property: $endpoint
     * Endpoint của api
     */
    protected $endpoint = '';
    /**
     * Property: $params
     * Các tham số khác sau endpoint, ví dụ /<endpoint>/<param1>/<param2>
     */
    protected $params = array();
    /**
     * Property: $file
     * Lưu trữ file của PUT request
     */
    protected $file = null;

    /**
     * Function: __construct
     * Just a constructor
     */
    public function __construct(){
        $this->_input();
        $this->_process_api();
    }

    /**
     * Allow CORS
     * Thực hiện lấy các thông tin của request: endpoint, params và method
     */
    private function _input(){
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");

        $this->params   = explode('/', trim($_SERVER['PATH_INFO'],'/'));
        $this->endpoint = array_shift($this->params);

        // Lấy method của request
        $method         = $_SERVER['REQUEST_METHOD'];
        $allow_method   = array('GET', 'POST', 'PUT', 'DELETE');

        if (in_array($method, $allow_method)){
            $this->method = $method;
        }

        // Nhân thêm dữ liệu tương ứng theo từng loại method
        switch ($this->method) {
            case 'POST':
                $this->params = $_POST;
            break;

            case 'GET':
                // Không cần nhận, bởi params đã được lấy từ url
            break;

            case 'PUT':
                $this->file    = file_get_contents("php://input");
            break;

            case 'DELETE':
                // Không cần nhận, bởi params đã được lấy từ url
            break;

            default:
                $this->response(500, "Invalid Method");
            break;
        }
    }

    /**
     * Thực hiện xử lý request
     */
    private function _process_api(){        
        if (method_exists($this, $this->endpoint)){
            $this->{$this->endpoint}();
        }
        else {
            $this->response(500, "Unknown endpoint");
        }
    }



    /**
     * Trả dữ liệu về client
     * @param: $status_code: mã http trả về
     * @param: $data: dữ liệu trả về
     */
    protected function response($status_code, $data = NULL){
        header($this->_build_http_header_string($status_code));
        header("Content-Type: application/json");
        echo json_encode($data);
        die();
    }

    /**
     * Tạo chuỗi http header
     * @param: $status_code: mã http
     * @return: Chuỗi http header, ví dụ: HTTP/1.1 404 Not Found
     */
    private function _build_http_header_string($status_code){
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error'
        );
        return "HTTP/1.1 " . $status_code . " " . $status[$status_code];
    }
}
```

## Cách sử dụng:

Để sử dụng class này, với mỗi endpoint chúng ta sẽ thêm một hàm vào class api đã được extends từ class restful_api ở trên. Ví dụ:

```javascript
require 'restful_api.php';

class api extends restful_api {

	function __construct(){
		parent::__construct();
	}

	function user(){
		if ($this->method == 'GET'){
			// Hãy viết code xử lý LẤY dữ liệu ở đây
			// trả về dữ liệu bằng cách gọi: $this->response(200, $data)
		}
		elseif ($this->method == 'POST'){
			// Hãy viết code xử lý THÊM dữ liệu ở đây
			// trả về dữ liệu bằng cách gọi: $this->response(200, $data)
		}
		elseif ($this->method == 'PUT'){
			// Hãy viết code xử lý CẬP NHẬT dữ liệu ở đây
			// trả về dữ liệu bằng cách gọi: $this->response(200, $data)
		}
		elseif ($this->method == 'DELETE'){
			// Hãy viết code xử lý XÓA dữ liệu ở đây
			// trả về dữ liệu bằng cách gọi: $this->response(200, $data)
		}
	}
}

$user_api = new api();
```
## Ví dụ: Tạo api lấy user ngẫu nhiên trong database
Trong ví dụ này mình sẽ lấy ngẫu nhiên một user trong bảng users bằng cách viết thêm hàm random_user và gọi `http://domain.com/api.php/random_user`

```javascript
require 'restful_api.php';

class api extends restful_api {

	function __construct(){
		parent::__construct();
	}

	function random_user(){
		if ($this->method == 'GET'){
			$connection = mysql_connect("localhost", 'root', 'usbw');
			mysql_select_db("rest", $connection);
			$query = mysql_query("select * from users ORDER BY RAND() LIMIT 1");
			$data = array();
			while($row = mysql_fetch_object($query)){
				$data[] = $row;
			}
			$this->response(200, $data);
		}
	}
}

$user_api = new api();
```

Hi vọng sau bài viết này, bạn sẽ hiểu thêm và có thể tự triển khai restful api cho project của mình. Toàn bộ source code của bài viết này các bạn có thể tải về trên [Github](https://github.com/buivannguyen/simple_restful). Mọi thắc mắc xin để lại dưới phần comment, mình sẽ trả lời sớm nhất.

**Video liên quan**: Nhờ cài win hộ, dân IT cảm thấy như thế nào?

<div class="youtube">
<iframe width="560" height="315" src="https://www.youtube.com/embed/zNCk6jctVW8" frameborder="0" allowfullscreen></iframe>
</div>
