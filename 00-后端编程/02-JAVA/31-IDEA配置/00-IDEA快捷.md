```
cmd + F12 --> 弹出 方法大纲
crtl + h  --> 当前 class 的 继承关系

crtl + Enter --> 创建一些函数

option + Enter --> 提示说明

crtl + v  --> 调出 git 工具面版
shift + cmd + k --> git push
```



## 代码提示

```
//psvm  生成main 方法
    public static void main(String[] args) {
 
        //sout  生成控制台输出
        System.out.println();
 
        //"string".sout   输出字符串
        System.out.println("string");
 
        //"string".format  字符串格式化
        String.format("string", 光标位置)
 
        //"test".try  生成try catch
        try {
            "test"
        } catch (Exception e) {
            e.printStackTrace();
        }
 
        //itar 生成array for代码块
        for (int i = 0; i < args.length; i++) {
            String arg = args[i];
            
        }
        //itco 生成Collection迭代
        for (Iterator iterator = collection.iterator(); iterator.hasNext(); ) {
            Object next =  iterator.next();
 
        }
        //iten  生成enumeration遍历
        while (enumeration.hasMoreElements()) {
            Object nextElement =  enumeration.nextElement();
 
        }
        //iter  生成增强forxun
        for (String arg : args) {
 
        }
 
        //itit  生成iterator 迭代
        while (iterator.hasNext()) {
            Object next =  iterator.next();
 
        }
 
        //itli  生成List的遍历
        for (int i = 0; i < list.size(); i++) {
            Object o =  list.get(i);
 
        }
 
        //ittok  生成String token遍历
        for (StringTokenizer stringTokenizer = new StringTokenizer(); stringTokenizer.hasMoreTokens(); ) {
            String s = stringTokenizer.nextToken();
 
        }
 
 
    }
    //psf  生成公共静态final
    private static final
 
    //psfi  生成公共静态 final int
    public static final int
 
    //psfs 生成公共静态final String
    public static final String


```







