# Php Router (Cannel)

Easy to use php router with auto and manual routing.

## 📁 Project Structure

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

> [!NOTE]
> Currently Auto Router can only rout files in `Pages/` directory. It will not regonize the sub folder in `Pages/` directory. If you want to use sub folder in `Pages/` directory, switch to manual router in `Setting.php`.

There's nothing special about `Components/`, it is just for sake of clear project structure. You can delete the folder or create one as you like.

`Layout/` is for header, footer and 404 pages.

`Cannel/` is the source folder for routing functions. You don't need to make changes here.

## 🛠️ Setting.php

`Setting.php` is for configuring the `Cannel` source code.

### Remove header on all pages

```text
Layout::$Header = false;
```

### Remove footer on all pages

```text
Layout::$Footer = false;
```

### Remove Header in Specific page

```text
Page::RemoveHeader("page-name");
```

### Remove Footer in Specific page

```text
Page::RemoveHeader("page-name");
```

### Load mysql database

```text
DB::LoadDB(true);
```

### Switch to html mode

```text
Router::$Extention = ".html";
```

### Disable Auto Router

```text
Page::$AutoRouter = false;
```

### Project name (remove if deploy to server )

```text
Router::$Root = "/project-name";
```

### Page::LoadBootstrap(false);

```text
Page::LoadBootstrap(false);
```

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
