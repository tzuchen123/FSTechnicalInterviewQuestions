# FSTechnicalInterviewQuestions
## Q10
見Q10資料夾

## Q12
### 功能 API

- `GET /api/posts` ：取得文章列表，預設時間排序（可以切換人工排序，數字由小到大），可以關鍵字搜尋
- `GET /api/posts/{id}` ：取得單篇文章
- `POST /api/posts` ：新增文章
- `PUT /api/posts/{id}` ：更新文章
- `DELETE /api/posts/{id}` ：刪除文章
- `PATCH /api/posts/{id}/activate` ：啟用文章
- `PATCH /api/posts/{id}/deactivate` ：停用文章
- `PATCH /api/posts/{id}/order` ：設定人工排序

---

### 架構設計

專案採用 **Controller / Service / Repository / Model** 分層：  

- **Controller**：處理請求與回應  
- **Service**：處理商業邏輯  
- **Repository**：資料庫存取邏輯  
- **Model**：Eloquent ORM 對應資料表  

---

### Migration

資料表 `posts`：

- `id` (bigint, primary key)
- `title` (string)
- `image` (string, nullable)
- `content` (text)
- `is_active` (boolean, 預設 1)
- `order_no` (integer, nullable)
- `timestamps`

---

### 測試

使用 **Laravel Feature Test** 驗證：  

- 文章列表只回傳啟用文章  
- 新增文章  
- 更新文章  
- 刪除文章  
- 文章上下架（Activate / Deactivate）  
- 人工排序  
- 搜尋功能  

---

## Q13
如何寫出輪播:

1.寫一個可以看到的窗口
---
width: 80%;
height: 400px;
overflow: hidden;
---

2.把五張圖橫著排在一起
---
display: flex;
width: 500%; /* 因為有 5 張圖 */
---

3.利用動畫控制膠卷往左移
---
animation: slide 20s infinite;
---

4.@keyframes 設定「每次移動 20%」
---
@keyframes slide {
  0%   { transform: translateX(0%); }
  20%  { transform: translateX(0%); }     
  25%  { transform: translateX(-20%); }  
  40%  { transform: translateX(-20%); }
  45%  { transform: translateX(-40%); }   
  60%  { transform: translateX(-40%); }
  65%  { transform: translateX(-60%); }   
  80%  { transform: translateX(-60%); }
  85%  { transform: translateX(-80%); }  
  100% { transform: translateX(-80%); }
}
---

如何寫出輪播:
conic-gradient是是 CSS 的一種漸層背景，專門用來做 圓形、圓餅圖（pie chart） 的效果。
用法是:
---
background: conic-gradient(
   顏色 百分比,
   顏色 百分比,
   顏色 百分比,
...
);
---

所以用var(--score)抓分數，有顏色部分的百分比就是 分數/ 5 *100%
---
background: conic-gradient (
    #4caf50 calc(var(--score) / 5 * 100%),
    #ddd 0);
---

## Q14
如果要自己打造一個框架，我會先把它拆解成幾個不同類別，參考過去使用過的框架，和過去工作經驗中遇到的痛點來思考需要哪些元件。

1. 核心組件
核心組件是框架最底層、也是最重要的部分，它的任務是：載入環境設定、初始化必要模組，並作為框架的進入點去組合其他功能。
環境設定元件:集中管理系統的設定（例如資料庫連線、快取機制、API key…），並能支援不同環境（dev / staging / prod）。
模組載入元件：類似於 Express.js 的 app.js，它是框架的進入點，負責初始化必要模組（例如 logger、DB 連線），並且按照順序載入其他功能（router、middleware、model、監控系統等），最後才啟動服務。


2. 請求處理組件
請求處理組件是開發者最常接觸的部分，負責request從進來到得到回應的整個流程。它確保系統能有條理地處理各種不同的 API 請求。
Router組件：決定不同 URL 對應到哪個功能。
Middleware組件：request進來時可以依序經過驗證、權限檢查、快取、日誌紀錄等，不同request都可以通過同一個middleware，集中管理邏輯，不用重複實作。

3. 資料組件
資料組件負責與資料庫進行溝通。
model組件：讓開發者寫orm、query builder或sql語法的地方，負責與資料庫進行溝通。
快取組件：幫model組件套用快取的地方，減少重複查詢。例如當同樣的查詢在短時間內多次發生，可以直接從快取回應，降低資料庫壓力。

4. 監控組件
監控組件用來確保系統在運行過程中能被有效觀察與追蹤，讓開發者能快速發現問題並即時反應。
log組件：集中記錄系統的運作狀態，包括錯誤訊息、請求紀錄等，讓開發者能在事後追蹤問題並進行效能分析。
即時通知組件:當系統發生錯誤或效能異常時，能立即通知，例如 Slack、Email、Line。

## Q15
15a.frontend (JavaScript) solution 
搜尋功能，我會在這個html檔案前面加上一個搜尋框跟button，當使用者搜尋時，會對每一列(row)的 innerText 做檢查，如果有關鍵字就顯示，否則就隱藏(display:none)。
排序功能，使用者點擊表頭時觸發排序，可以點擊切換排序方式（小到大或是大到小），把整張表格內的資料轉成陣列，每一列會是一個元素，然後再用sort去排序，排序後重新把結果顯示在表格內。
分頁功能，預設一頁十筆（也可以加上一個輸入框讓使用者自定義），根據目前的頁數跟筆數去決定要顯示哪些資料，另外要寫ui去顯示現在在第幾頁跟全部有幾頁。

15b.backend solution 
假設會有前端去呈現畫面，前端會去跟後端要資料，後端回傳資料（ex.json格式），類似於前後端分離，後端提供api的模式。

1.有db
先用node.js/php/python把資料存到table
---
CREATE TABLE employees (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50),
  position VARCHAR(50),
  age INT,
  start_date DATE
);
---
後端用sql語法或ORM實作，ORM寫法類似於Q12，sql寫法如下。
---
-- 搜尋
SELECT * FROM employees 
WHERE name LIKE '%alex%';

-- 排序
SELECT * FROM employees 
ORDER BY age ASC;

-- 分頁
SELECT * FROM employees 
ORDER BY age ASC
LIMIT 10 OFFSET 10;
---

2.沒有db
當前端呼叫 API 的時候，後端程式會去讀取一個html檔案，將表格內的每一列資料解析並轉換成陣列，每一列就是陣列的一個元素。
搜尋功能，建一個空陣列，迴圈原始陣列，把有關鍵字的丟到剛剛建的新陣列，最後將新陣列轉成json回給前端。
排序功能，根據前端給的想要排序的欄位（ex.name）跟方式（asc or desc），對陣列去sort，sort完成後轉成json回給前端。
分頁功能，根據前端給的頁數和筆數，計算出要回傳的資料，將符合範圍的資料切割(slice)出來。最後把分頁後的資料加上現在在第幾頁跟全部有幾頁，一起回傳 JSON。

## Q16
圖見Q16資料夾，解釋如下：
要設計一個部落格網站的管理後台，該網站有三種主要使用者和功能如下
- 管理員可以新增文章
- 註冊使用者可以把文章加到最愛跟加到資料夾
- 非註冊使用者只能看

然後要設計的是給管理員用的後台界面，還要包含使用者管理跟使用者最愛文章管理。
為了讓管理員好上手，我設計的是常見的後台介面：左上角會有logo，右上角會有目前使用者和登出按鈕，
左邊是分頁選單，可以根據功能去切換分頁，雖然題目只有要求使用者管理和使用者最愛文章，但我覺得這個網站應該還有別的功能，例如文章管理，廣告管理，權限管理，系統設定等不同功能。

1.後台介面：這頁是後台一進去就會看到的頁面，所以應該會放對網站最重要的資訊，我想了一下什麼是對網站最重要，所以挑了四個我認為最重要的指標：總文章數、註冊用戶數、今日瀏覽量和總收藏數，代表了網站內容是否有更新，跟網站流量是否有增長。
2.使用者管理：這個功能比較直觀，內容有搜尋跟使用者列表，搜尋就是可以搜尋特定使用者或選擇不同狀態使用者（全部/正常/停權），列表則是列出使用者主要資訊，跟可以點選Edit按鈕看此使用者詳細資訊，並進行編輯資訊。
3.使用者最愛文章管理：我覺得這一頁十分重要，因為部落格網站主要是提供資訊來吸引使用者使用，所以這一頁可以幫助管理員了解哪些內容最受用戶歡迎。分為最愛文章列癟跟資料夾列表，最愛文章列表會列出文章跟該篇文章被多少使用者添加最愛以及最近添加最愛時間，也可以透過功能鍵去對文章進行操作，列表也可以依照最愛數或最近添加最愛時間排序。資料夾列表則是會列出使用者建立了那些資料夾，資料夾收藏多少文章，最近收藏文章時間等，同樣列表也可以根據不同欄位順序排序。

## Q17
inner join只取出兩個表格中「都有符合條件」的資料，right join會保留右邊表格的資料，如果左邊表格沒有資料會顯示null。
所以inner join的時候，只會取出UserID 1/3的資料，right join的時候會取出UserID 1/3/4/5的資料，但是UserID 4/5的Name跟Age欄位資料會是null

## Q18

## Q19
要設計一個高流量架構必須考慮高併發處理能力和水平擴展和容錯性，我想用四個層面去回答，分別是架構面，應用（程式）面，資料庫面和監控面。
1.架構面：
- 水平擴展:可以透過auto scaling機制去動態生成多台應用伺服器，然後搭配負載平衡去將流量分配到不同伺服器。
- 負載平衡:如 AWS ELB可以把流量分配到多台應用伺服器，避免單一伺服器超載。
- 反向代理: 如 Nginx、Apache，位於應用伺服器前端，可以根據規則（如 URL、Header、使用者地區）分配流量，也可以cache部分動態或靜態回應，降低伺服器壓力。
- 靜態資源快取：如果靜態資源多，也可以用cdn cache住，減少應用伺服器與資料庫的負擔。

2.應用（程式）面:
- 程式碼優化：首先，最重要的一定是把程式碼寫好，用適合的資料結構，簡化演算法複雜度，避免n+1 query等。
- 應用面cache：針對熱門查詢結果做cache。
- 非即時工作排程：將寄信、報表之類的非即時工作丟入 Queue（如 RabbitMQ、Kafka、SQS），避免阻塞主流程。

3.資料庫面
資料庫則是資料一致性跟效能的trade off，如果因為非常重視資料正確性，把隔離等級都設成Serializable，會導致大量鎖定與等待，效能大幅下降，不適合高流量環境，所以必須根據業務需求決定在哪些交易場景提高隔離等級。
但還是有以下常見優化手法：
- 索引設計：根據常見查詢條件設計複合索引，減少全表掃描。
- 讀寫分離：主庫負責寫入，從庫負責查詢。
- 分庫分片：對大型資料集做水平切分，降低單一節點壓力。

4.監控面
- 即時監控：利用雲端平台的工具，例如：aws cloudwatch，可以監控EC2、RDS等資源的狀態（CPU、記憶體、連線數、IOPS 等），並可設定有問題時發送通知。
- 查 Log：除了即時監控，還能搭配laravel log或 nginx access/error log。例如：當 cloudWatch 告訴你「CPU 飆高」時，可以回頭透過 log 找到是哪個請求造成的問題。

## Q20
這張圖的特點是平常連線數很低（20–30），但在特定日期（12/27、1/04 00:00）瞬間飆到 400 或 1000。我的排查步驟如下：

- 先確認最近是否有程式碼更新，特別是排程或批次任務。
- 透過 DB 監控工具（例如 AWS RDS Performance Insights、SHOW PROCESSLIST），觀察當下的 SQL 語句，判斷是否有長時間查詢或鎖表。
- 檢查應用層與 log：再透過伺服器監控工具（CloudWatch、APM、Laravel log、Nginx log），確認是否有異常的大量連線或請求進入。

我會往兩個方向分析：
如果是
1.大量外部連線造成的，可能是流量攻擊（如 DDoS、爬蟲），可以嘗試檢查流量來源IP、User-Agent，是否有異常模式。
2.連線正常但被程式拉高，可能是近期更新功能或排程產生問題，例如：排程在 00:00 同時跑大批任務，程式碼有連線未釋放，造成 connection leak，SQL 沒有 index，查詢過久導致連線堆積。

最後，建立通知制度，在連線數超標時即時通知工程師。