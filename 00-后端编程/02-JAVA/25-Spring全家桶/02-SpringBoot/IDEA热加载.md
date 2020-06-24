## IDEA热加载

解决更新代码需要重启服务的问题.

`dependencies` 中添加

```
</dependencies>
  <dependency>
  <groupId>org.springframework.boot</groupId>
  <artifactId>spring-boot-devtools</artifactId>
  <optional>true</optional>
  </dependency>
</dependencies>
```

IDEA配置 `Bulid project automatically `(打勾)

启动是`mvn spring-boot:run `

修改代码之后需要手动执行 build, 快捷键是 (cmd+F9)或者(cmd+shift+F9)



