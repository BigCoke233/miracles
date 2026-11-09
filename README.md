> [!important]
> 本项目已经近六年未更新，尚未兼容最新的、修复了 PHP2Shell 漏洞的 PHP 版本。新版本将在一两个月内发布，目前不建议使用最新发行版，可以临时使用 `master` 分支中的最新开发版。

<div align="center">

# Miracles

<img src="https://img.shields.io/badge/made%20with-%E2%9D%A4-ff69b4.svg?style=flat-square"> 
<a href="LICENSE"><img src="https://img.shields.io/badge/license-AGPLv3-blue.svg?style=flat-square"></a> 
<a href="https://typecho.org"><img src="https://img.shields.io/badge/for-Typecho-blueviolet.svg?style=flat-square"></a> 
<a href="https://github.com/BigCoke233/miracles/releases"><img src="https://img.shields.io/github/v/release/BigCoke233/miracles?color=red&style=flat-square"></a> 
<a href="https://github.com/BigCoke233/miracles/graphs/contributors"><img src="https://img.shields.io/github/contributors/BigCoke233/miracles?color=orange&style=flat-square"></a> 

<p align="center">🖐️ <strong>Hand-crafted since 2019</strong>

</div>

---

## 🎨 特色

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

## 🚀 使用

1. 下载**最新的 [Release](https://github.com/BigCoke233/miracles/releases)**
2. 确保自身 PHP 环境在 7.1.0 及以上版本，并装有 CURL 拓展（否则一些功能无法正常使用）
3. 解压后，**确认目录名为 `Miracles`（M 大写）**
4. 将文件夹放入 Typecho 根目录下的`usr/themes/`
5. 到后台-外观-可用的主题中，启用主题
6. **根据 [wiki](docs/wiki.md)** 配置主题

<details><summary>使用开发版</summary><br>

直接下载仓库，或者使用 git 命令行进行克隆。
```git
$ git clone https://github.com/BigCoke233/miracles.git
```
> 不推荐使用开发版，因为可能有不确定的不稳定因素，并且不一定有有利改动<br>如果你使用开发版出现任何问题，欢迎通过 issue 反馈，在等待回复期间请使用发行版

</details>
<details><summary>遇到问题</summary><br>

如果在使用过程中遇到了任何问题，可以先阅读本主题的 [Wiki](docs/wiki.md)，并进行一些简单的确认：清理浏览器缓存，更换网络环境，确保 Console 内没有提示访问不到文件等自身原因。如果你无法靠自己解决问题，可以尝试联系作者，但记住**开发者没有为你解决问题的义务，只是出于好心的帮助。**  
在确认你遇到的现象确实是一个 Bug 后，请在 [Issues](https://github.com/BigCoke233/miracles/issues) 提交问题，并为该问题尽可能的描述清楚，按照提供的 issue 模板进行填写，谢谢配合。

</details>

## 💖 鸣谢

> 这些都是在开发过程中给予我帮助的项目和大佬！

### 开源项目

- [jQuery](https://github.com/jquery/jquery) - 若干开源项目和主题内一些 js 的前置
- [Highlight.js](https://github.com/highlightjs/highlight.js) - 代码高亮
- [Hightlight-line-numbers](https://github.com/wcoder/highlightjs-line-numbers.js) - 代码行号
- [Pjax](https://github.com/defunkt/jquery-pjax) - Pjax 预加载
- [Nprogress](https://github.com/rstacruz/nprogress) - Pjax 滚动条动画
- [OwO](https://github.com/DIYgod/OwO) - 评论 OwO 表情
- [Pangu.js](https://github.com/vinta/pangu.js) -分割中英文字符
- [Normalize.css](http://necolas.github.io/normalize.css/) - 保证不同浏览器上各元素 css 默认效果相同
- [qrcode.js](https://github.com/davidshimjs/qrcodejs) - 生成文章二维码
- [details-element-polyfill](https://github.com/javan/details-element-polyfill) - 优化 details 标签兼容性
- [hint.css](https://kushagra.dev/lab/hint/) - 工具提示 Tooltip
- [toaster.js](https://github.com/BigCoke233/toaster.js/) - Toast 提示框
- [libra.js](https://codeberg.org/eltrac/libra) - 图片灯箱
- [TableContents](https://github.com/lutdev/table-contents) - 生成文章目录

### 贡献者

这里只列出贡献「相对较大」的贡献者，所有的贡献者名单请到[这里](https://github.com/BigCoke233/miracles/graphs/contributors)查看

| 贡献者 | 贡献内容 |
| ------ | ------- |
| [@BigCoke233 (Eltrac)](https://github.com/BigCoke233) | 原作者 / 主要维护者 |
| [@outtimes](https://github.com/outtimes) | 提供各种有用的功能 |
| [@ohmyga233](https://github.com/ohmyga233) | 实现 Ajax 评论无刷新 |
| [@kengwang](https://github.com/kengwang) | 提供追番页面 |

### 参考

[VOID](https://github.com/AlanDecode/Typecho-Theme-VOID) | [Castle](https://github.com/ohmyga233/castle-Typecho-Theme) | [Holakit](https://github.com/wenxuanjun/Holakit) | [Material](https://github.com/idawnlight/typecho-theme-material) | [Mirages](https://get233.com/archives/mirages-intro.html)

## 🔮 相关

说明文档：[Wiki.md](docs/wiki.md) | [Notion(被墙了,故停止维护)](https://www.notion.so/eltrac/c7c631e21b3345caa2a09bd2fb5dd4b2)   
更新日志：[change-log.md](docs/change-log.md)  

---

`miracles` 是以 [GNU Affero General Public License](https://github.com/BigCoke233/miracles/blob/master/LICENSE) 授权的自由软件。
