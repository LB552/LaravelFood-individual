# The Food Store

A grocery store product management application built with Laravel. Manage products, categories, and inventory with an intuitive admin interface.

## Live Site

**[TODO: Paste your deployed site URL here]**

## Features

- **View Products**: Browse all products with sorting and filtering
- **Filter Products**: Filter by category and price range
- **Sort Products**: Sort alphabetically (case-insensitive) by product name or category, or numerically by price
- **Add Products**: Create new products with name, image URL, category, price, and description
- **Create Categories**: Add new categories on-the-fly while creating or editing products
- **Edit Products**: Update product details including image URLs
- **Delete Products**: Remove products from inventory
- **Product Details**: Click on a product name to view full product information
- **Category Navigation**: Click a category to filter products by that category

## Getting Started

### Prerequisites

- PHP 8.5+
- Composer
- SQLite (default) or MySQL
- Node.js (for asset compilation)

### Installation

1. Clone the repository
```bash
git clone <repository-url>
cd grocery-admin
```

2. Install PHP dependencies
```bash
composer install
```

3. Copy the environment file
```bash
cp .env.example .env
```

4. Generate application key
```bash
php artisan key:generate
```

5. Run migrations and seed default products
```bash
php artisan migrate:fresh --seed
```

This will create the database tables and populate them with default products:
- **Candy**: Lollipop
- **Dairy**: Cheese, Milk
- **Fruits**: Banana, Melon, Orange
- **Meat**: Hot Dog

6. Start the development server
```bash
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser.

## Usage

### Filtering Products

1. Click the **"Filter products"** button
2. Select a category (or leave blank for all categories)
3. Enter minimum and/or maximum price (optional)
4. Click **"Apply Filter"** to see results
5. Click **"Reset"** to clear filters

Filters persist when sorting and can be combined.

### Sorting Products

Click on **Product**, **Category**, or **Price** column headers to sort:
- First click: Sort ascending (↑)
- Second click: Sort descending (↓)
- Product and Category sort alphabetically (case-insensitive)
- Price sorts numerically

Sorting preserves active filters.

### Adding Products

1. Click the **"Add"** button
2. Fill in product details:
   - **Name** (required)
   - **Image URL** (optional - use local paths like `product-images/myimage.jpg` or full URLs)
   - **Category** (required - or create a new one)
   - **Price** (required)
   - **Description** (optional)
3. Click **"Save"** to add the product

### Editing Products

1. Click the **"Edit"** button on any product row
2. Update any field
3. Click **"Save"** to apply changes

### Deleting Products

1. Click the **"Delete"** button on any product row
2. Confirm the deletion in the dialog

### Viewing Product Details

Click on any **product name** to view the full product page with:
- Product image
- Category (clickable to filter by category)
- Full description
- Price

## Technology Stack

- **Backend**: Laravel 12
- **Frontend**: Blade templating, vanilla JavaScript
- **Database**: SQLite
- **Styling**: CSS3 (Grid layout, flexbox)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
