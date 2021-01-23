## class常量池

​    我们写的每一个Java类被编译后，就会形成一份class文件；

**class文件中除了包含类的版本、字段、方法、接口等描述信息外，还有一项信息就是常量池(constant pool table)**，用于存放编译器生成的各种**字面量**(Literal)和**符号引用**(Symbolic References)；**每个class文件都有一个class常量池**。

 class文件常量池主要存放两大常量：`字面量`和`符号引用`。



  **2.2:什么是字面量和符号引用：**

​    **字面量包括：**

​      1.文本字符串

​      2.八种基本类型的值

​      3.被声明为final的常量等;

​    **符号引用包括：**

​      1.类和方法的全限定名

​      2.字段的名称和描述符

​      3.方法的名称和描述符。



```java
class JavaBean{
    private int value = 1;
    public String s = "abc";
    public final static int f = 0x101;

    public void setValue(int v){
        final int temp = 3;
        this.value = temp + v;
    }

    public int getValue(){
        return value;
    }
}
```

通过javac命令编译之后，用javap -v 命令查看编译后的文件:

```
class JavaBasicKnowledge.JavaBean
  minor version: 0
  major version: 52
  flags: ACC_SUPER
Constant pool:
   #1 = Methodref          #6.#29         // java/lang/Object."<init>":()V
   #2 = Fieldref           #5.#30         // JavaBasicKnowledge/JavaBean.value:I
   #3 = String             #31            // abc
   #4 = Fieldref           #5.#32         // JavaBasicKnowledge/JavaBean.s:Ljava/lang/String;
   #5 = Class              #33            // JavaBasicKnowledge/JavaBean
   #6 = Class              #34            // java/lang/Object
   #7 = Utf8               value
   #8 = Utf8               I
   #9 = Utf8               s
  #10 = Utf8               Ljava/lang/String;
  #11 = Utf8               f
  #12 = Utf8               ConstantValue
  #13 = Integer            257
  #14 = Utf8               <init>
  #15 = Utf8               ()V
  #16 = Utf8               Code
  #17 = Utf8               LineNumberTable
  #18 = Utf8               LocalVariableTable
  #19 = Utf8               this
  #20 = Utf8               LJavaBasicKnowledge/JavaBean;
  #21 = Utf8               setValue
  #22 = Utf8               (I)V
  #23 = Utf8               v
  #24 = Utf8               temp
  #25 = Utf8               getValue
  #26 = Utf8               ()I
  #27 = Utf8               SourceFile
  #28 = Utf8               StringConstantPool.java
  #29 = NameAndType        #14:#15        // "<init>":()V
  #30 = NameAndType        #7:#8          // value:I
  #31 = Utf8               abc
  #32 = NameAndType        #9:#10         // s:Ljava/lang/String;
  #33 = Utf8               JavaBasicKnowledge/JavaBean
  #34 = Utf8               java/lang/Object
```



**1) 字面量**： 字面量接近java语言层面的常量概念，主要包括：

- **文本字符串**，也就是我们经常申明的： public String s = "abc";中的"abc"

  ```
  #9 = Utf8               s
  #3 = String             #31            // abc
  #31 = Utf8              abc
  ```

- 用final修饰的成员变量，包括静态变量、实例变量和局部变量

```
#11 = Utf8               f
#12 = Utf8               ConstantValue
#13 = Integer            257
```

这里需要说明的一点，上面说的存在于常量池的字面量，指的是数据的值，也就是abc和0x101(257),通过上面对常量池的观察可知这两个字面量是确实存在于常量池的。

**而对于基本类型数据(甚至是方法中的局部变量)，也就是上面的private int value = 1;常量池中只保留了他的的字段描述符I和字段的名称value，他们的字面量不会存在于常量池。**



***\*2) 符号引用\**
**符号引用主要设涉及编译原理方面的概念，包括下面三类常量:

- 类和接口的全限定名，也就是java/lang/String;这样，将类名中原来的"."替换为"/"得到的，主要用于在运行时解析得到类的直接引用，像上面

  ```
  #5 = Class              #33            // JavaBasicKnowledge/JavaBean
   #33 = Utf8               JavaBasicKnowledge/JavaBean
  ```

- 字段的名称和描述符，字段也就是类或者接口中声明的变量，包括类级别变量和实例级的变量

  ```
  #4 = Fieldref           #5.#32         // JavaBasicKnowledge/JavaBean.value:I
  #5 = Class              #33            // JavaBasicKnowledge/JavaBean
  #32 = NameAndType       #7:#8          // value:I
  
  #7 = Utf8               value
  #8 = Utf8               I
  
  //这两个是局部变量，值保留字段名称
  #23 = Utf8               v
  #24 = Utf8               temp
  ```

  可以看到，对于方法中的局部变量名，class文件的常量池仅仅保存字段名。

- 方法中的名称和描述符，也即参数类型+返回值

  ```
  #21 = Utf8               setValue
  #22 = Utf8               (I)V
  
  #25 = Utf8               getValue
  #26 = Utf8               ()I
  ```

  























