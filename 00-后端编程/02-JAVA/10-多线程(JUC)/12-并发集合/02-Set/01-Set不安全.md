```java
/**
 * 同理可证 ：ConcurrentModificationException
 * //1、Set<String> set = Collections.synchronizedSet(new HashSet<>());
 * //2、
 */
public class SetTest {
  public static void main(String[] args) {
    Set<String> set = new HashSet<>();
    // hashmap
    // Set<String> set = Collections.synchronizedSet(new HashSet<>());
    // Set<String> set = new CopyOnWriteArraySet<>();

    for (int i = 1; i <=30 ; i++) {
      new Thread(()->{
        set.add(UUID.randomUUID().toString().substring(0,5));
        System.out.println(set);
      },String.valueOf(i)).start();
    }
  }
}
```

## 解决方案

2种

```java
1. Set<String> set = Collections.synchronizedSet(new HashSet<>());
2. Set<String> set = new CopyOnWriteArraySet<>();
```

