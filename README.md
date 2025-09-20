# FSTechnicalInterviewQuestions

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

## Q12

