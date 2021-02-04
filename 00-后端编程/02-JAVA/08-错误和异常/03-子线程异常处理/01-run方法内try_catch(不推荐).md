

```java
@Override
public void run() {
  try {
    throw new RuntimeException();
  } catch (RuntimeException e) {
    System.out.println("Caught Exception.");
  }
}
```

