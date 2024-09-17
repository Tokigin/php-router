# Php Router (Cannel)

Easy to use php router with auto and manual routing.

## 📁 Project Structure

```text
/
├── Cannel/
├── Components/
│   └── hero-banner.php/
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

`Cannel` looks for `.php` or `.html` files in the `Pages/` directory. Each page is exposed as a route based on its file name. To use `.html` files, switch extension in Setting.php.

There's nothing special about `Sections/`, it is just for sake of clear project structure. You can delete the folder or create one as you like.

`Layout/` is for header, footer and 404 pages.

`Cannel/` is the source folder for routing functions. You don't need to make changes here.

## 🛠️ Setting.php

`Setting.php` is for configuring the `Cannel` source code.

### Change Home page

```text
Router::$Home_Page = "home";
```

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

### Switch to html

```text
Router::$Extension = ".html";
```

### Disable Auto Router

```text
Page::$AutoRouter = false;
```

### Project name (remove if deploy to server )

```text
Router::SetRoot("project-name");
```

## 📄 index.php

`index.php` is the root page of the project. You can modify elements in here. However, leave the `Page::Index();` in `<Body>` tag for the routing to work.

### Add Bootstrap

```text
Page::LoadBootstrap();
```

### Add Tailwind

```text
Page::LoadTainwind();
```

## 📄 ManualRouter.php

`ManualRouter.php` is used for manual routing or routing in sub folder. This file can be deleted if you are using Auto Router.
Use `"Request URl" => "File Path"` array structure for manual routing.

## Default Values

| Code                               | Action                                     | Default |
| :--------------------------------- | :----------------------------------------- | :------ |
| `Router::SetRoot("project-name");` | Project name (remove if deploy to server ) | /       |
| `Router::$Home_Page = "home";`     | Change Home page                           | True    |
| `Layout::$Header = false;`         | Remove header on all pages                 | True    |
| `Layout::$Footer = false;`         | Remove footer on all pages                 | True    |
| `Page::RemoveHeader("page-name");` | Remove Header in Specific page             | None    |
| `Page::RemoveFooter("page-name");` | Remove Footer in Specific page             | None    |
| `Router::$Extension = ".html";`    | Switch to html mode                        | .php    |
| `Page::$AutoRouter = false;`       | Disable Auto Router                        | True    |
| `Page::LoadBootstrap();`           | Add Bootstrap                              | True    |
| `Page::LoadTailwind();`            | Add Tailwind                               | True    |
