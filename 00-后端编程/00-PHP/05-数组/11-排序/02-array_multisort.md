## 多维数组的指定两个字段排序

```php
$arr = array(
  '0' => array(
    'id' => 3,
    'age' => 27
  ),
  '1' => array(
    'id' => 5,
    'age' => 50
  )，
  '2' => array(
    'id' => 4,
    'age' => 44
  ),
  '3' => array(
    'id' => 3,
    'age' => 78
  ) 
);
foreach ( $arr as $key => $row ){
  $id[$key] = $row ['id'];
  $age[$key] = $row ['age'];
}
array_multisort($id, SORT_ASC, $age, SORT_DESC, $arr);
print_r($arr);

```



