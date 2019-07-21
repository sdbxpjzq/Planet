## 获取select 选中的value

```html
<select name="jumpMenu"
 onchange="MM_jumpMenu(this)"> 
<option value="http://www.manongjc.com/">码农教程</option> 
<option value="http://www.manongjc.com/">html教程</option> 
</select> 

<script type="text/javascript"> 
function MM_jumpMenu(that){ 
	that.options[that.selectedIndex].value
} 
</script> 
```

