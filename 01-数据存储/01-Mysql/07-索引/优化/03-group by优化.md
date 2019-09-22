- `group by`实质是`先排序后分组`, 遵照索引建的`最佳左前缀`

- 当无法使用索引列, 增加`max_length_for_sort_data`参数的设置 + 增加`sort_buffer_size`参数的设置
- `where`高于`having`, 能写在`where`限定的条件就不要去`having`限定了



