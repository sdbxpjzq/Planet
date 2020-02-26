最近最少使用策略

LRU使用了— 哈希链表 

什么是哈希链表呢？

哈希表是由若干个Key-Value所组成。在“逻辑”上，这些Key-Value是无所谓排列顺序的，谁先谁后都一样。

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g3wvvf3ff5j30gj033jrf.jpg)

在哈希链表当中，这些Key-Value不再是彼此无关的存在，而是被一个链条串了起来。每一个Key-Value都具有它的前驱Key-Value、后继Key-Value，就像双向链表中的节点一样。

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g3wvvn2vc6j30mf033dfz.jpg)

这样一来，原本无序的哈希表拥有了固定的排列顺序。

**依靠哈希链表的有序性, 我们可以把key-value按照最后的使用时间来排序.**



让我们以用户信息的需求为例，来演示一下LRU算法的基本思路：

1.假设我们使用哈希链表来缓存用户信息，目前缓存了4个用户，这4个用户是按照时间顺序依次从链表右端插入的。

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g3wvxg51thj30hd03i0su.jpg)

2.此时，业务方访问用户5，由于哈希链表中没有用户5的数据，我们从数据库中读取出来，插入到缓存当中。这时候，链表中最右端是最新访问到的用户5，最左端是最近最少访问的用户1。

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g3wvxm71svj30m603idg1.jpg)

3.接下来，业务方访问用户2，哈希链表中存在用户2的数据，我们怎么做呢？我们把用户2从它的前驱节点和后继节点之间移除，重新插入到链表最右端。这时候，链表中最右端变成了最新访问到的用户2，最左端仍然是最近最少访问的用户1。

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g3wvxsr6nsj30m607paaa.jpg)

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g3wvxwfuxej30m603idg1.jpg)

4.接下来，业务方请求修改用户4的信息。同样道理，我们把用户4从原来的位置移动到链表最右侧，并把用户信息的值更新。这时候，链表中最右端是最新访问到的用户4，最左端仍然是最近最少访问的用户1。

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g3wvy2u50rj30m607ijrm.jpg)

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g3wvy6a2gjj30m603imxd.jpg)

5.后来业务方换口味了，访问用户6，用户6在缓存里没有，需要插入到哈希链表。假设这时候缓存容量已经达到上限，必须先删除最近最少访问的数据，那么位于哈希链表最左端的用户1就会被删除掉，然后再把用户6插入到最右端。

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g3wvycf446j30m603iwep.jpg)

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g3wvyg58qaj30m703iq35.jpg)

以上，就是LRU算法的基本思路。

代码实现:

```java
class A {
    private Node head;
    private Node end;

    //缓存存储上限
    private int limit;
    private HashMap<String, Node> hashMap;

    public LRUCache(int limit) {
        this.limit = limit;

        hashMap = new HashMap<String, Node>();
    }

    public String get(String key) {
        Node node = hashMap.get(key);

        if (node == null) {
            return null;
        }

        refreshNode(node);

        return node.value;
    }

    public void put(String key, String value) {
        Node node = hashMap.get(key);

        if (node == null) {
            //如果key不存在，插入key-value
            if (hashMap.size() >= limit) {
                String oldKey = removeNode(head);

                hashMap.remove(oldKey);
            }

            node = new Node(key, value);

            addNode(node);

            hashMap.put(key, node);
        } else {
            //如果key存在，刷新key-value
            node.value = value;

            refreshNode(node);
        }
    }

    public void remove(String key) {
        Node node = hashMap.get(key);

        removeNode(node);

        hashMap.remove(key);
    }

    /**

     * 刷新被访问的节点位置

     * @param  node 被访问的节点

     */
    private void refreshNode(Node node) {
        //如果访问的是尾节点，无需移动节点
        if (node == end) {
            return;
        }

        //移除节点
        removeNode(node);

        //重新插入节点
        addNode(node);
    }

    /**

     * 删除节点

     * @param  node 要删除的节点

     */
    private String removeNode(Node node) {
        if (node == end) {
            //移除尾节点
            end = end.pre;
        } else
         if (node == head) {
            //移除头节点
            head = head.next;
        }
        else {
            //移除中间节点
            node.pre.next = node.next;

            node.next.pre = node.pre;
        }

        return node.key;
    }

    /**

     * 尾部插入节点

     * @param  node 要插入的节点

     */
    private void addNode(Node node) {
        if (end != null) {
            end.next = node;

            node.pre = end;

            node.next = null;
        }

        end = node;

        if (head == null) {
            head = node;
        }
    }

    public static void main(String[] args) {
        LRUCache lruCache = new LRUCache(5);

        lruCache.put("001", "用户1信息");

        lruCache.put("002", "用户1信息");

        lruCache.put("003", "用户1信息");

        lruCache.put("004", "用户1信息");

        lruCache.put("005", "用户1信息");

        lruCache.get("002");

        lruCache.put("004", "用户2信息更新");

        lruCache.put("006", "用户6信息");

        System.out.println(lruCache.get("001"));

        System.out.println(lruCache.get("006"));
    }

    class Node {
        public Node pre;
        public Node next;
        public String key;
        public String value;

        Node(String key, String value) {
            this.key = key;

            this.value = value;
        }
    }
}

```





















## 链表实现

维护一个有序单链表，越靠近链表尾部的结点是越早之前访问的。当有一个新的数据被访问时，我们从链表头开始顺序遍历链表。

1. 如果此数据之前已经被缓存在链表中了，我们遍历得到这个数据对应的结点，并将其从原来的位置删除，然后再插入到链表的头部。

2. 如果此数据没有在缓存链表中，又可以分为两种情况：

   1. 如果此时缓存未满，则将此结点直接插入到链表的头部；

   2. 如果此时缓存已满，则链表尾结点删除，将新的数据结点插入链表的头部。



## 数组实现

方式一：首位置保存最新访问数据，末尾位置优先清理
当访问的数据未存在于缓存的数组中时，直接将数据插入数组第一个元素位置，此时数组所有元素需要向后移动1个位置，时间复杂度为O(n)；当访问的数据存在于缓存的数组中时，查找到数据并将其插入数组的第一个位置，此时亦需移动数组元素，时间复杂度为O(n)。缓存用满时，则清理掉末尾的数据，时间复杂度为O(1)。
方式二：首位置优先清理，末尾位置保存最新访问数据
当访问的数据未存在于缓存的数组中时，直接将数据添加进数组作为当前最有一个元素时间复杂度为O(1)；当访问的数据存在于缓存的数组中时，查找到数据并将其插入当前数组最后一个元素的位置，此时亦需移动数组元素，时间复杂度为O(n)。缓存用满时，则清理掉数组首位置的元素，且剩余数组元素需整体前移一位，时间复杂度为O(n)。（优化：清理的时候可以考虑一次性清理一定数量，从而降低清理次数，提高性能。）