# PHP Reverse Proxy

> 基于 PHP 的反向代理

## 特性

- 直接输入域名即可访问, 例如 `httpbin.org/get`
- 替换页面内的 URL, 例如 `http://example.com/login => http://~/proxy/http://example.com/login`
- 支持 GET 和 POST 请求

## 已知 Bug

- 无法识别重定向
- 无法携带 Cookies
- 不支持相对 URL 替换, 例如 `/blog/1` 和 `./features`
- 不支持前端路由
- 无法自动识别 `Content-Type`
- 不支持动态页面跳转, 例如 `window.location.href = "/blog/1"`
