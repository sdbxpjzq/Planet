

```php
interface demo
{
    const A = 10;
    public function A();
    public function B();
}

```

1. 定义的所有方法都必须是`public`
2. 不能被实例化
3. 所有的方法不能有主体
4. 一个`class`可以实现多个`interface`
5. `interface`中可以有属性, 但必须都是常量
6. `interface`可以继承其他的`interface`



```php
//定义接口
interface User{
    function getDiscount();
    function getUserType();
}
//VIP用户 接口实现
class VipUser implements User{
    // VIP 用户折扣系数
    private $discount = 0.8;
    function getDiscount() {
        return $this->discount;
    }
    function getUserType() {
        return "VIP用户";
    }
}
class Goods{
    var $price = 100;
    var $vc;
    //定义 User 接口类型参数，这时并不知道是什么用户
    function run(User $vc){
        $this->vc = $vc;
        $discount = $this->vc->getDiscount();
	$usertype = $this->vc->getUserType();
        echo $usertype."商品价格：".$this->price*$discount;
    }
}

$display = new Goods();
$display ->run(new VipUser);	//可以是更多其他用户类型
```

该例子演示了一个 PHP 接口的简单应用。该例子中，User 接口实现用户的折扣，而在 VipUser 类里面实现了具体的折扣系数。最后商品类 Goods 根据 User 接口来实现不同的用户报价。