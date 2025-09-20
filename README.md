# FSTechnicalInterviewQuestions
## Q10

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