# amirkabir-site

## Project setup
```
npm install
```

### Compiles and hot-reloads for development
```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### Lints and fixes files
```
npm run lint
```
### all api syntax 
```
url = api/api.php
مقادیر خود  درخواست
"type":"......"
```
### api for check login (access ex = modir , dabir , honarjo)
```
api/api.php
whith post method
{"username": ".....","password":".....","access" : "....", "type":"checkusers","sid":"چک شو اگر کاربر سیشن داشت فقط سیشن رو بفرسته تا کاربر لاگین دوباره نکنه و گرنه یه سیشن بسازه همراه با این اطلاعات برای من بفرسته"}
```
### api for list class for dabir dashbord
```
api/api.php
whith post method
 { "type":"listclassdabir","dabirname":"علی"}
```

### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).
