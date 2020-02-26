[TOC]



# **vue-router**

## 手册

https://router.vuejs.org/zh-cn/

## 路由对象

在使用了 vue-router 的应用中，路由对象会被注入每个组件中，赋值为 `this.$route` 和`this.$router`，并且当路由切换时，路由对象会被更新。

### this.$route

http://www.cnblogs.com/avon/p/5943008.html

http://www.cnblogs.com/wisewrong/p/6277262.html

http://www.cnblogs.com/keepfool/p/5690366.html

- $route.path 
  字符串，等于当前路由对象的路径，会被解析为绝对路径，如 `"/home/news"` 。
- $route.params 
  对象，包含路由中的动态片段和全匹配片段的键值对
- $route.query 
  对象，包含路由中查询参数的键值对。例如，对于 `/home/news/detail/01?favorite=yes` ，会得到`$route.query.favorite == 'yes'` 。
- $route.router 
  路由规则所属的路由器（以及其所属的组件）。
- $route.matched 
  数组，包含当前匹配的路径中所包含的所有片段所对应的配置参数对象。
- $route.name 
  当前路径的名字，如果没有使用具名路径，则名字为空。

### this.$router





## v-link

在a元素上使用`v-link`指令跳转到指定路径。

```html
<div class="list-group">
    <a class="list-group-item" v-link="{ path: '/home'}">Home</a>
    <a class="list-group-item" v-link="{ path: '/about'}">About</a>
</div>
```



## \<router-view>标签







```js
import Router from 'vue-router'
export default new Router({
    mode: 'history',
  routes: [
    {
      path: '/',
      name: 'vueCollection',
      component: Collection
    }
  ]
})
```

**路由元信息- 配置`meta`**

```js
const router = new VueRouter({
  routes: [
    {
      path: '/foo',
      component: Foo,
      children: [
        {
          path: 'bar',
          component: Bar,
          // a meta field
          meta: { requiresAuth: true }
        }
      ]
    }
  ]
})
```



# **控制title和分享信息 -- vue-meta**

别人写的:

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1fhy7rqo67dj30h806qt8u.jpg)



https://github.com/declandewet/vue-meta

router.js

```js
import Vue from 'vue'
import Router from 'vue-router'
import Meta from 'vue-meta'

Vue.use(Router)
Vue.use(Meta)
```

collection.vue

```js
export default {
        name: 'vueCollection',
        metaInfo: {
                    title: '我是聚合页',
                    meta: [
                        { property: "og:title",content:"我是聚合页的分享title"},
                        { property: "og:description",content:"我是聚合页的分享title"},
                        { property: "og:url",content:"我是聚合页的分享title"},
                        { property: "og:image",content:"image"},
                    ]
                }
}
```



另外参考:

1. ![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fhj661ashij30g605maa4.jpg)


1. https://segmentfault.com/a/1190000007387556




# 懒加载

我们我要路由对应的组件定义成异步组件

```js
const SendMsg  = resolve => {
  // require.ensure 是 Webpack 的特殊语法，用来设置 code-split point
  // （代码分块）
    require.ensure(['@/components/page/SendMsg.vue'],()=>{
        resolve(require('@/components/page/SendMsg.vue'))
    })
}
```

```js
{
    path: '/sendmsg',
    component: SendMsg
}
```

还有一种简单的写法:

```js
{
	path: '/sendmsg',
    component: resolve => require(['../components/page/SendMsg.vue'], resolve)
                }
```



# 路由守卫

https://router.vuejs.org/zh-cn/advanced/navigation-guards.html

每次每一个路由改变的时候都得执行一遍.

```js
router.beforeEach(function (to,from,next) {
//    每次每一个路由改变的时候都得执行一遍
    next(); // 必须调通
});
```

afterEach 没有 next 方法，不能改变导航，代表已经确定好了导航怎么去执行后，附带的一个执行钩子函数.

```js
router.afterEach(function (to, from) {
    // todo
});
```







