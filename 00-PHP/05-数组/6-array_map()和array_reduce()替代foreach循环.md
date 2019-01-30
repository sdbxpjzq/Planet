## array_reduce

`array_reduce( $arr , [callable] $callback ) `

使用回调函数迭代地将数组简化为单一的值。

其中\$arr 为输入数组，\$callback($result , $value)接受两个参数,\$result为上一次迭代产生的值，$value是当前迭代的值。

使用array_reduce()替代foreach()循环最常用的一个业务场景也许就是数组求和，比如:

```
$arr = array('1','2','3'); //计算数组中数字的和
	$sum = 0;
	foreach($arr as $v){  //使用 foreach循环计算
	  $sum  += $v;// echo $sum
	}
	echo array_reduce($arr , function($result , $v){ //使用array_reduce()迭代求和
	  Return $result+$v;
	});
```

再比如，从数据库中查询出一组数据，接下来想得到他们的 id 值，拼接成类似 (1,2,3,4,5) 字符串，然后在 “SELECT * WHERE id in(1,2,3,4,5) ” 处理，这时候完全可以 foreach() 数组处理，其实也可以使用 array_reduce()，因为 array_reduce()就是“迭代地将数组简化为单一的值”，如下

```
$arr = array(
	array("id"=>1,'name'=>"a"),
	array("id"=>2,"name"=>"c"),
	array("id"=>3,"name"=>"d")
     );
      echo array_reduce($arr , function($result , $v){
	Return $result.','.$v['id'];
      });
```

在业务中遇到foreach循环处理，有时候我们就可以想想能不能像这样处理。

## array_map

`array_map(callback $callback , $arr) ` 

返回用户自定义函数作用后的数组。回调函数接受的参数数目应该和传递给 array_map() 函数的数组数目一致。

向array_map传入数组，出来的还是数组，而不是上面array_reduce()的一个值。所以，array_map()最简单的就是把callback函数作用到每个数组的值上，最常见的场景就是 intval()、trim()  数组中的值，在一些框架的源码中也经常见到，比如：

```
$arr = array('2','3','4','5');

array_map('intval' , $arr);//在拼接sql查询的时候，很有用

array_map('htmlspecialchars' , $arr);
```

虽然有时候foreach完全可以达到相同的效果，但是在代码中使用 array_map、array_reduce还有array_filter之类的函数，可以让代码更加的简洁，而不是一个php文件到处都是foreach循环。