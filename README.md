<p align="center">
    <img src="./.github/clockwork-logo-1.png" alt="Clockwork CMS"><br>
</p>

Clockwork CMS is a CMS written in vanilla PHP for managing static pages. Ever struggled to convert static pages into something like WordPress? It can be a nightmare. Clockwork CMS is perfect for that kind of situations.


> [!CAUTION]
> Clockwork CMS is under development and it isn't usable right now.


## Installation

Before you start you have to have two things:

- web server with php interpreter (it could be xampp for example)
- static page website

Then you have to clone the **Clockwork CMS** repo into previusly created directory.

```
$ git clone https://github.com/kmtrebacz/clockwork-cms . 
```

Then you have to delete everything from `clockwork-website/`. Then put static pages into it.

Now you have to start the web server. Now admin page will be available at `website-adress.com/clockwork-admin`.


## To do
- [ ] clockwork-admin/pages
     - [x] Rename files
     - [ ] Set URLs
     - [ ] Delete files
     - [ ] Display pages on defined URLs
- [ ] clockwork-admin/settings
- [ ] Page Editor