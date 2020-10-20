## 交集-retainAll

通过判断集合的大小，来确定是否存在交集。不能通过方法返回的True和False来判断。

```java
ArrayList<String> listA= new ArrayList<String>();
listA.add("Tom");
ArrayList<String> listB= new ArrayList<String>();
listB.add("Tom");

listA.retainAll(listB);
// 通过判断集合的大小，来确定是否存在交集
if(listA.size()>0){
  System.out.println("这两个集合有相同的交集");
}else{
  System.out.println("这两个集合没有相同的交集");
}
```