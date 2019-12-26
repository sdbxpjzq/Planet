![](https://pic.superbed.cn/item/5e031cf076085c3289008774.jpg)

- 像`String`,`包装类`等实现了`Comparable`接口, 重写了`compareTo(obj)`方法
- 实现`Comparable`接口的对象可以通过`Collections.sort()`或者`Arrays.sort()`进行自动进行排序. 
- 



## 重写`compareTo(obj)`规则

- 当前对象(`this`)  > 形参对象(`obj`),   返回`正整数`
- 当前对象(`this`)  < 形参对象(`obj`),   返回`负整数`
- 当前对象(`this`)  = 形参对象(`obj`),   返回`0`























