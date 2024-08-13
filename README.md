# Php Router (Cannel)

Easy to use php router with auto and manual routing.

## Project Structure

```text
/
├── Cannel/
├── Components/
│   └── herobanner.php/
├── Layout/
│   └── 404.html/
│   └── 404.php/
│   └── Footer.php/
│   └── Header.php/
├── Pages/
├── .htaccess/
├── index.php/
├── ManualRouter.php/
└── Setting.php/
```

`Cannel` looks for `.php` or `.html` files in the `Pages/` directory. Each page is exposed as a route based on its file name. To use `.html` files, switch extention in Setting.php.

There's nothing special about `Components/`, it is just for sake of clear project structure. You can delete the folder or create one as you like.

`Layout/` is for header, footer and 404 pages.

`Cannel/` is the source folder for routing functions. You don't need to make changes here.

## 🛠️ Setting.php

`Setting.php` is for configuring the `Cannel` source code.

| Code                               | Action                                     | Default |
| :--------------------------------- | :----------------------------------------- | :------ |
| `Layout::$Header = false;`         | Remove header on all pages                 | True    |
| `Layout::$Footer = false;`         | Remove footer on all pages                 | True    |
| `Page::RemoveHeader("page-name");` | Remove Header in Specific page             | None    |
| `Page::RemoveFooter("page-name");` | Remove Footer in Specific page             | None    |
| `DB::LoadDB(true);`                | Load mysql database                        | False   |
| `Router::$Extention = ".html";`    | Switch to html mode                        | .php    |
| `Page::$AutoRouter = false;`       | Disable Auto Router                        | True    |
| `Router::$Root = "/project-name";` | Project name (remove if deploy to server ) | /       |
| `Page::LoadBootstrap(false);`      | Remove Bootstrap                           | True    |

## 🛠️ ManualRouter.php

`ManualRouter.php` is used for manual routing or routing in sub folder. This file can be deleted if you are using Auto Router.
Use `Request URl" => "File Path"` array structure for manual routing.