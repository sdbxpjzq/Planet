SADD：向指定Set中添加1个或多个member，如果指定Set不存在，会自动创建一个。时间复杂度O(N)，N为添加的member个数
SREM：从指定Set中移除1个或多个member，时间复杂度O(N)，N为移除的member个数
SRANDMEMBER：从指定Set中随机返回1个或多个member，时间复杂度O(N)，N为返回的member个数
SPOP：从指定Set中随机移除并返回count个member，时间复杂度O(N)，N为移除的member个数
SCARD：返回指定Set中的member个数，时间复杂度O(1)
SISMEMBER：判断指定的value是否存在于指定Set中，时间复杂度O(1)\

SMOVE：将指定member从一个Set移至另一个Set

