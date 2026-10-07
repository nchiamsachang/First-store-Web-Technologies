# Balanced Living Web Store

A small e-book storefront for a fictional wellness organization, "Balanced Living", built as a Web Technologies course project. It combines a static HTML/CSS site, a JavaScript shopping cart, and PHP pages backed by MySQL.

This is coursework, not a production store: no real payments are taken.

## Features

- **Home page** (`index.html`): banner, drop-down navigation menu, and an image slideshow that rotates every three seconds.
- **E-book store** (`store_index.html`): category pages for Health and Parenting, each linking to its books.
- **Product pages from the database** (`processProduct.php`): the category pages link here. Name, description, price and stock come from MySQL. A book with no inventory shows "Sold Out", and you can't order more than is in stock. "Buy Now" takes that one book to checkout.
- **Checkout** (`checkout.html`, `processCheckout.php`): validates name, address, state, zip, phone and card number in the browser, then records the customer and order and reduces the inventory.
- **Shopping cart** (`Cart.html`, `cart.js`): an earlier, cookie-based version of the store. The static product pages (`wheat.html` and the others) add books to a cart that is kept in browser cookies for seven days; items can be removed and totals are recalculated. The category pages no longer link to these product pages, so open them directly.
- **Blog** (`Admin.html`, `Process.php`, `Blog.php`): an admin form posts an entry with an optional image; entries are saved to `blog.txt` and shown newest first.

## Built with

HTML, CSS, JavaScript, PHP and MySQL.

## Running it

The home page, category pages and cookie cart are plain HTML, so you can open `index.html` in a browser to look around. Clicking a book, checking out and the blog need a PHP server with MySQL, such as [XAMPP](https://www.apachefriends.org/).

1. Copy the project files into the web server's root folder (for XAMPP, `htdocs`). The blog form posts to `http://localhost/process.php`, so the files need to be at the root, not in a subfolder.
2. Start Apache and MySQL.
3. Create the database and tables described below.
4. Put your database settings in `config.txt`, one per line: host, user, password, database name.
5. Go to `http://localhost/index.html`.

### Database

The PHP pages expect three tables. No SQL script is included in the repository, so they need to be created by hand.

| Table | Columns used |
| --- | --- |
| `Product` | `item_no`, `ebook_name`, `description`, `image`, `price`, `inventory` |
| `Customer` | `cc_no`, `exp_mo`, `exp_yr`, `name_first`, `name_last`, `email`, `address1`, `address2`, `city`, `state`, `zip`, `phone`, `fax`, `mail_list` |
| `Orders1` | `cc_no`, `item_no`, `quantity`, `date_sold` |

`Product` needs one row per book, with `item_no` 0 to 3 for the health books and 4 to 7 for the parenting books. `image` holds the file name only, for example `WheatBelly.jpg`.

## Project layout

| Path | Purpose |
| --- | --- |
| `index.html` | Home page |
| `store_index.html`, `health.html`, `Parenting.html` | Store and category pages |
| `wheat.html`, `exercise.html`, `daniel.html`, `soul.html`, `expect.html`, `expect1.html`, `mama.html`, `kids.html` | Static product pages that add to the cookie cart |
| `cart.js`, `Cart.html` | Cart logic and cart page |
| `processProduct.php` | Database-driven product page |
| `checkout.html`, `processCheckout.php` | Checkout form and order processing |
| `Admin.html`, `Process.php`, `Blog.php` | Blog entry form, save handler, and blog page |
| `config.txt` | Database connection settings |
| `images/` | Book covers, slideshow images and icons |
| `store.sln`, `store.vbproj`, `Web.config`, `My Project/` | Visual Studio project files |

## Known gaps

- The Financial and Programming categories are linked from the store page, but those pages don't exist yet.
- Most links in the navigation menu are placeholders.
