`byName` 通过匹配 bean 的 id是否跟 setter 对应，对应则自动装配。

意思就是说，如果我的 Person 中有一个 `setCat()` 而配置文件中有一个 **「bean 的 id 为 cat」**，则能够自动装配。



