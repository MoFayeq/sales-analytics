# Advanced Real-Time Sales Analytics System

A Laravel-based backend system designed to manage and analyze sales data **in real-time**. The project includes AI integration for product recommendations, weather-based dynamic pricing, and WebSocket-powered real-time updates via **Laravel Reverb**.

---

## 🚀 Features

- **Order Management API** – Create and manage orders.
- **Real-Time Analytics** – Get live metrics (revenue, top products, order count).
- **WebSocket Support** – Real-time broadcasting of order/analytics updates using Laravel Reverb.
- **AI Integration** – Uses OpenAI ChatGPT to provide sales strategy suggestions.
- **Weather Integration** – Fetches weather data to offer dynamic pricing and product recommendations.

---

## 🛠️ Tech Stack

- **Backend**: Laravel (Manual DB queries, no ORM)
- **Real-Time Engine**: Laravel Reverb (WebSocket)
- **Database**: SQLite
- **AI Integration**: OpenAI (ChatGPT API)
- **External API**: OpenWeatherMap API

---

## 📦 API Endpoints

### 1. Orders

- `POST /orders`
  - **Body**: `product_id`, `quantity`, `price`, `date`
  - **Function**: Stores a new order and publishes real-time update

### 2. Analytics

- `GET /analytics`
  - **Returns**:
    - Total revenue
    - Top products by sales
    - Revenue change in the last minute
    - Orders in the last minute

### 3. AI Recommendations

- `GET /recommendations`
  - Sends recent sales data to ChatGPT
  - Returns product promotions or strategic actions

### 4. Weather-Aware Pricing

- Integrated in `/recommendations` using OpenWeatherMap API
- Example: Promote cold drinks on hot days or suggest price adjustments based on temperature

---

## ⚡ Real-Time Features

- **Broadcasted Events**:
  - New orders
  - Updated analytics

- **Technology Used**: Laravel Reverb
- **Client**: Subscribes via WebSockets to live updates

---

## 📄 Manual vs AI Implementation

### ✅ Manually Implemented
- All database queries (raw SQL)
- WebSocket event broadcasting
- Weather API integration
- Real-time analytics aggregation

### 🤖 AI-Assisted
- Prompt design and logic for ChatGPT
- Boilerplate for `recommendations` controller
- Structuring endpoint documentation

---

## 🧪 Testing

### Example Test Case
- **Test**: Adding a new order should increase the total revenue and trigger a WebSocket event.

```bash
php artisan test
```

At least one test is written for each core feature (orders, analytics, AI, real-time).

---

## 🧰 How to Run the Project

1. Clone the repo and navigate to the project folder.
2. Install dependencies:

```bash
composer install
```

3. Set up environment:

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure `.env`:
   - Set your OpenAI and OpenWeatherMap API keys
   - Ensure `BROADCAST_DRIVER=reverb`

5. Migrate the database:

```bash
php artisan migrate
```

6. Start the server:

```bash
php artisan serve
```

7. Start Laravel Reverb:

```bash
php artisan reverb:start
```

---

## 📝 Notes

- This project uses **SQLite** for lightweight deployment.
- No ORM (like Eloquent) is used; all queries are raw.
- Laravel Reverb is required for real-time broadcasting.

---

## 📧 Contact

If you have questions or suggestions, feel free to reach out!