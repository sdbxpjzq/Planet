## ffmpeg安装

```shell
yum install -y epel-release
sudo rpm –import /etc/pki/rpm-gpg/RPM-GPG-KEY-EPEL-7
yum repolist
sudo rpm –import http://li.nux.ro/download/nux/RPM-GPG-KEY-nux.ro
sudo rpm -Uvh http://li.nux.ro/download/nux/dextop/el7/x86_64/nux-dextop-release-0-1.el7.nux.noarch.rpm
yum repolist
yum install -y ffmpeg


```

## 对mp4文件进行ts切片并生成m3u8文件

```shell
wget https://bigfile.mafengwo.net/s12/M00/6A/15/wKgED1v3aheAce0aANW9rZq7yNo156.mp4
重名名
rename wKgED1v3aheAce0aANW9rZq7yNo156,mp4 abc.mp4 wKgED1v3aheAce0aANW9rZq7yNo156.mp4

先用ffmpeg把abc.mp4文件转换为abc.ts文件：

ffmpeg -y -i abc.mp4 -vcodec copy -acodec copy -vbsf h264_mp4toannexb abc.ts



再用ffmpeg把abc.ts文件切片并生成playlist.m3u8文件，5秒一个切片：

ffmpeg -i abc.ts -c copy -map 0 -f segment -segment_list playlist.m3u8 -segment_time 5 abc%03d.ts


```

