## DiscardPolicy-丢弃策略

直接丢弃任务，不予任何处理也不抛出异常，如果允许任务丢失，这是最好的拒绝策略。

功能：直接静悄悄的丢弃这个任务，不触发任何动作

## 使用场景

如果你提交的任务无关紧要，你就可以使用它 。因为它就是个空实现，会悄无声息的吞噬你的的任务。所以这个策略基本上不用了

