### 0. 계정관련
- required column: email, business_id, access_tocken
- facebook 계정을 확인하고, 추가/수정을 위한 기능
##### 1) 계정 확인
- pram: id
- return: user
<blockquote>curl GET http://54.180.195.238/user/1</blockquote>

##### 2) 계정 생성
- email은 unique함
<blockquote>curl POST http://54.180.195.238/user?email=test@gmail.com&business_id=1111&access_tocken=2222</blockquote>

##### 3) 계정 업데이트
- ID를 분실하였으면, email로 POST 하여 확인 가능 
<blockquote>curl PUT http://54.180.195.238/user/1?email=test@gmail.com&business_id=1111&access_tocken=2222</blockquote>

<br />

### 1. 페이스북 카탈로그 생성 및 확인
##### 1) 사용자의 입력에 따라 페이스북 카탈로그를 생성
- 추가로 필요한 정보가 있다면, request로 입력
- required param: name, access_tocken, business_id
- return: catalog_id
<blockquote>curl POST http://54.180.195.238/catalogs?name=Test&access_token=EAAKh01UzLjMBAOtc1lPBsn5rbPCujTYsOqMYmRV2jSQSmQZBIjgZB7p1rMb95J7a3zv7SWigFHZApsd5V8Hg6lmUW5yE632HHGtdyRvM3g6bKRQucIpXvuI5ie7b6z83QCZAcONtNZBuXcUrubEYV4peZCIn2eHMG2EUPQuJZA0BWXfGaLTWLoU&business_id=174056747059771</blockquote>

##### 2)카탈로그 정보 확인
- pram: id
- return: catalog
<blockquote>curl GET http://54.180.195.238/catalogs/1</blockquote>

<br />

### 2. 데이터 피드 업로드용 CSV 다운로드 API
- 제공된 [상품 API]를 사용하여 상품 목록을 가져와 페이스북 데이터 피드 규격에 맞는 CSV파일을 생성
<blockquote>http://54.180.195.238/dataFeeds/download</blockquote>

<br />

### 3. 제품세트 생성 API
- required param: name, access_tocken, business_id, filter
- return: product_set_id
- 사용자의 입력에 따라 페이스북 제품세트를 생성
- 사용자의 입력은 상품의 조건이 포함 e.g. product_type LIKE shirt
- 추가로 필요한 정보가 있다면, request로 입력
- 제품세트 조건에 만족하는 상품이 없다면 에러를 반환
<blockquote>curl POST http://54.180.195.238/productSet?name=test1&catalog_id=2344168832305586&filter=product_type LIKE shirt&access_tocken=EAAKh01UzLjMBAOtc1lPBsn5rbPCujTYsOqMYmRV2jSQSmQZBIjgZB7p1rMb95J7a3zv7SWigFHZApsd5V8Hg6lmUW5yE632HHGtdyRvM3g6bKRQucIpXvuI5ie7b6z83QCZAcONtNZBuXcUrubEYV4peZCIn2eHMG2EUPQuJZA0BWXfGaLTWLoU</blockquote>
