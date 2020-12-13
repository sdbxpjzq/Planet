@Transactional 注解的方法都是被外部其他类调用才有效，那么如果方法修饰符是 private 的，这个方法能被外部其他类调到么？

既然调不到，事务生效有意义吗？想通这套逻辑就行了。

**记住**：@Transactional 注解只能应用到 public 方法上。如果你在 protected、private 或者 package-visible 的方法上使用 @Transactional 注解，它也不会报错， 但是这个被注解的方法将不会加入事务之行。

