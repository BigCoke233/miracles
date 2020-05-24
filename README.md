![](banner.png)

<p align="center">
<img src="https://img.shields.io/badge/build-passing-brightgreen.svg?style=flat-square"> 
<img src="https://img.shields.io/badge/made%20with-%E2%9D%A4-ff69b4.svg?style=flat-square"> 
<a href="LICENSE"><img src="https://img.shields.io/badge/license-SATA-blue.svg?style=flat-square"></a> 
<a href="https://typecho.org"><img src="https://img.shields.io/badge/for-Typecho-blueviolet.svg?style=flat-square"></a> 
<a href="https://github.com/BigCoke233/miracles/releases"><img src="https://img.shields.io/github/v/release/BigCoke233/miracles?color=red&style=flat-square"></a> 
<a href="https://github.com/BigCoke233/miracles/graphs/contributors"><img src="https://img.shields.io/github/contributors/BigCoke233/miracles?color=orange&style=flat-square"></a> 
    
<p align="center"><strong>记录你心中的奇迹，书写你自己的篇章</strong></p>

---

> **使用主题时，如果需要任何基础功能上的帮助，请先查看[说明文档](docs/wiki.md)！**  
> 同时，欢迎加入 QQ 交流群：924171480，或者 [Telegram](https://dev.guhub.cn/tg)

## 特色

- 响应式 / 自适应设计
- Pjax 全站无刷新
- Ajax 评论无刷新
- 支持系统切换夜间模式
- 调用 bilibili API 显示追番页面
- 前台登录
- 图片懒加载
- 代码高亮 / 行号
- 不错的兼容性
    - 夜间模式下的 Pio 插件按钮样式
    - 夜间模式下的 Aplayer 播放器
    - Bilibili 外链长宽比例
- 良好的阅读体验
    - 阅读时长估计
    - 字数统计
    - 两种可供选择的字体（思源宋体/黑体）
- 不错的自定义性能
    - 两种可供选择的导航栏
    - 多种图片懒加载动画供选择
    - 黑白滤镜（哀悼模式）
- 灵活的友情链接功能
- 方便排版的短代码
- 后台设置备份

### 预览

[作者博客](https://guhub.cn/) | [Miracles 常用页面元素示例](https://guhub.cn/miracles-content-style-demo.html)

## 使用

1. Star 本项目（遵循 SATA 开源协议）
2. 下载**最新的 [Release](https://github.com/BigCoke233/miracles/releases)**
3. 解压后，**确认目录名为`Miracles`（M 大写）**
4. 将文件夹放入 Typecho 根目录下的`usr/themes/`
5. 到后台-外观-可用的主题中，启用主题
6. **根据 [wiki](https://www.notion.so/eltrac/c7c631e21b3345caa2a09bd2fb5dd4b2)** 配置主题

<details><summary>使用开发版</summary><br>

直接下载仓库，或者使用 git 命令行进行克隆。
```git
$ git clone https://github.com/BigCoke233/miracles.git
```
> 不推荐使用开发版，因为可能有不确定的不稳定因素，并且不一定有有利改动<br>如果你使用开发版出现任何问题，欢迎通过 issue 反馈，在等待回复期间请使用发行版

</details>
<details><summary>遇到问题</summary><br>

如果在使用过程中遇到了任何问题，可以先阅读本主题的 [Wiki](https://www.notion.so/eltrac/c7c631e21b3345caa2a09bd2fb5dd4b2)，并进行一些简单的确认：清理浏览器缓存，更换网络环境，确保 Console 内没有提示访问不到文件等自身原因。如果你无法靠自己解决问题，可以尝试联系作者，但记住**开发者没有为你解决问题的义务，只是出于好心的帮助。**  
在确认你遇到的现象确实是一个 Bug 后，请在 [Issues](https://github.com/BigCoke233/miracles/issues) 提交问题，并为该问题尽可能的描述清楚，按照提供的 issue 模板进行填写，谢谢配合。

</details>
<details><summary>关于版权</summary><br>

主题基于 SATA 协议开源，使用前你需要给这个项目点一个 Star，使用或转发时**请保留版权信息**，禁止倒卖。若需二次开发后发布，请邮件通知我`hi#guhub.cn`，并保留原作者版权信息及仓库链接。同时，如果发现有侵权行为，请告知我，屡教不改者将被列入[黑名单](docs/black-list.md)，删除版权的用户不会在遇到问题时受到来自作者的帮助，在后期可能会加入删除版权网站设置项失效的惩罚。

</details>

### 更新日志

**Ver.1.5.4 Your best nightmare**

- 增加：适配夜间模式的图标  
可在根目录下创建 faviconDark.ico，如果这个文件存在而系统又为深色模式的时候，就将 favicon 替换成这个文件
- 优化：移动端下，追番项目一行显示两个
- 优化：优化夜间模和日落模式
- 优化：导航栏 :hover 毛玻璃效果优化
- 移除：提交评论时小电视动画

> 所有历史版本的更新日志请查看[这里](docs/change-log.md)

<details><summary>开发版更新日志</summary><br>

**v20200503A**

- 优化：夜间模式下，notice 块的背景色

**v20200505A**

- 优化：导航栏毛玻璃效果调整
- 优化：导航栏透明度调整

**v20200505B**

- 优化：将 kbd 的短代吗语法修改为 `[[kbd]]`

**v20200514A**

- 优化：用 canvas 替换代码块的 mac 按钮图片

**v20200517A**

- 修复：暴力解决访问密码文章时被 pjax 强制刷新的问题

**v20200524A**

- 优化：鼠标移动到文章卡片标题上时显示完整标题

</details>

## 计划

- [ ] 增加：内置站点缓存规则
- [ ] 优化：「说说页面」的样式
- [ ] 优化：文章缩略图自动剪裁
- [ ] 新增：图片横向排版「相册功能」（参考：https://blog.imalan.cn/archives/282/）
- [ ] 优化：用 web storage 替换储存夜间/日落模式等的 cookie
- [ ] 新增：全站加密功能
- [ ] 新增：支持 PWA - 渐进式 Web 应用
- [ ] 新增：添加语言包功能，通过 php 数组储存各个语言版本的文字
- [ ] 新增：嵌入 GitHub 仓库 / 用户（以卡片形式展示）
- [ ] 新增：根据 cid 嵌入本站文章（以卡片形式展示）
- [ ] 新增：文章目录
- [ ] 优化：密码提示（可在加密文章中自定义对密码的提示）
- [ ] 新增：全站公告
- [ ] 优化：对日间模式/日落模式/夜间模式的切换通过下拉面板操作，并支持禁用主题跟随系统设置
- [ ] 新增：导航支持下拉面板
- [ ] 优化：页面/文章评论列表隐藏时，不显示评论数

## 鸣谢

> 这些都是在开发过程中给予我帮助的项目和大佬！

### 开源项目

- [jQuery](https://github.com/jquery/jquery) - 若干开源项目和主题内一些 js 的前置
- [FancyBox](https://github.com/fancyapps/fancybox) - 文章图片灯箱
- [Highlight.js](https://github.com/highlightjs/highlight.js) - 代码高亮
- [Hightlight-line-numbers](https://github.com/wcoder/highlightjs-line-numbers.js) - 代码行号
- [Pjax](https://github.com/defunkt/jquery-pjax) - Pjax 预加载
- [Nprogress](https://github.com/rstacruz/nprogress) - Pjax 滚动条动画
- [OwO](https://github.com/DIYgod/OwO) - 评论 OwO 表情
- [LazyLoad](https://github.com/tuupola/lazyload) - 图片懒加载
- [Pangu.js](https://github.com/vinta/pangu.js) -分割中英文字符
- [Normalize.css](http://necolas.github.io/normalize.css/) - 保证不同浏览器上各元素 css 默认效果相同
- [qrcode.js](https://github.com/davidshimjs/qrcodejs) - 生成文章二维码

### 贡献者

这里只列出贡献「相对较大」的贡献者，所有的贡献者名单请到[这里](https://github.com/BigCoke233/miracles/graphs/contributors)查看

| 贡献者 | 贡献内容 |
| ------ | ------- |
| [@BigCoke233 (Eltrac)](https://github.com/BigCoke233) | 原作者 / 主要维护者 |
| [@outtimes](https://github.com/outtimes) | 提供各种有用的功能 |
| [@ohmyga233](https://github.com/ohmyga233) | 实现 Ajax 评论无刷新 |
| [@kengwang](https://github.com/kengwang) | 提供追番页面 |

### 参考

[VOID](https://github.com/AlanDecode/Typecho-Theme-VOID) | [Castle](https://github.com/ohmyga233/castle-Typecho-Theme) |
[Holakit](https://github.com/wenxuanjun/Holakit) | [Material](https://github.com/idawnlight/typecho-theme-material) | [Mirages](https://get233.com/archives/mirages-intro.html)

## 相关

演示站点：[我的博客](https://guhub.cn)  |  以及 Sponsor 中的站点链接  
介绍文章：[Miracles —— 生为奇迹](https://guhub.cn/p/miracles.html)  
说明文档：[Wiki](docs/wiki.md) | [Notion(旧)](https://www.notion.so/eltrac/c7c631e21b3345caa2a09bd2fb5dd4b2)   
更新日志：[change-log.md](docs/change-log.md)  
侵权网站：[black-list.md](docs/black-list.md)

## 捐助

你可以通过[爱发电](https://afdian.net/@Eltrac)向我投食，~~用金钱催更~~。

---

Copyright &copy; 2019-2020 [Eltrac](https://github.com/BigCoke233), released under [SATA License](https://github.com/zTrix/sata-license).
