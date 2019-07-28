![](banner.jpg)
![](https://img.shields.io/badge/build-passing-brightgreen.svg)
![](https://img.shields.io/badge/made%20with-%E2%9D%A4-ff69b4.svg)
![](https://img.shields.io/badge/license-MIT-blue.svg)
![](https://img.shields.io/badge/for-Typecho-blueviolet.svg)
![](https://img.shields.io/badge/version-1.2.0-red.svg)
> 🙌 Born to be the Miracles. 生为奇迹

语言：简体中文 | [English](README-en.md)

# 特色
- 响应式/自适应设计
- Pjax 预加载技术
- LazyLoad 图片懒加载
- Prism 代码高亮+行号
- 前台设置面板，调整字体/字体大小
- OwO 评论表情
- 内置 Live2d，可以选择黑猫和白猫，也能自定义模型（开发版）
- 舒适的夜间模式
- 有趣的日落/黑白滤镜
- 两种导航栏样式
- 全站公告
- 自定义摘要
- 20 张随机缩略图(文件大的根因)
- ~~体积较小（压缩后 4M 左右）~~

# 使用
1. Star 本项目
2. 前往 [Releases](https://github.com/BigCoke233/miracles/releases) 下载最新发行版
3. 解压并存放在`/usr/themes`目录下
4. 确认目录名是否为`Miracles`（大写 M）
6. 后台-控制台-外观 启用本主题
7. 阅读 [Wiki](https://github.com/BigCoke233/miracles/wiki) 和后面的常规配置后，开始使用
## 常规配置

<details>
  <summary><strong>添加友链（友情链接）</strong></summary>

在文章或独立页面中按照以下语法书写。
```
!!!
[links]
...
[链接名字]{指向链接}(头像)
[链接名字]{指向链接}(头像)
...
[/links]
!!!
```
> 如果你是 1.0 及以前版本的 Typecho ，可以在开头和结尾添加`!!!`

</details>
<details>
<summary><strong>关于页面的设置</strong></summary>

创建关于页面的时候选择“关于页面”模板，然后添加自定义字段，如图。
![](https://camo.githubusercontent.com/02f656335888aed14b815f5bf1d072e5efa2b403/68747470733a2f2f73322e617831782e636f6d2f323031392f30372f32352f6565546845342e706e67)

</details>
<details>
<summary><strong>代码高亮无效?</strong></summary>

你需要在书写代码块的时候定义语言，这样 Prism.js 才能够正确解析。
```markdown
(```语言)
相应语言的代码（正常书写时，请去掉括号）
(```)
```

> 如果没有定义语言，就会被视作为 html 语言进行解析

</details>
<br>

> 在这里未提及的问题请查看 [Wiki](https://github.com/BigCoke233/miracles/wiki)

# 鸣谢
> 这些都是在开发过程中给予我帮助的项目和大佬！
## 开源项目
- [jQuery](https://github.com/jquery/jquery)
- [FancyBox](https://github.com/fancyapps/fancybox)
- [Prism.js](https://github.com/PrismJS/prism)
- [Nprogress](https://github.com/rstacruz/nprogress)
- [OwO](https://github.com/DIYgod/OwO)
- [Pjax](https://github.com/defunkt/jquery-pjax)
- [LazyLoad](https://github.com/tuupola/lazyload)
- [Pangu.js](https://github.com/vinta/pangu.js)

## 大佬们
[@ohmyga233](https://github.com/ohmyga233) | 
[@AlanDecode](https://github.com/AlanDecode) | 
[@gfwyuexia](https://github.com/gfwyuexia) | 
[@jrotty](https://github.com/jrotty)

# 相关
演示站点：[我的博客](https://guhub.cn)  
介绍文章：[Miracles —— 生为奇迹](https://guhub.cn/p/miracles.html)  
更新日志：[change-log.md](https://github.com/BigCoke233/miracles/blob/master/change-log.md)  
更新计划：[plan.md](https://github.com/BigCoke233/miracles/blob/master/plan.md)  

# 协议
&copy; Typecho Theme Miracles is under MIT License.

> Just enjoy it~
