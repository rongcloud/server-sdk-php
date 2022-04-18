Server SDK 功能支持的版本清单

| 模块   | 方法名    | 说明           | 支持版本（Tags）   |
| :-----| :-----  | :------ | :----- |
| [用户信息](./RongCloud/Lib/User/User.php) | register | 注册， 获取 token| 3.0.1 |
|  | update | 更新用户信息 | 3.0.1 |
|  | get | 获取用户信息 | 3.0.7 |
|  | getGroups | 查询用户所在群组 | 3.0.12 |
|  | expire | Token 失效 | 3.0.14 |
| [检查用户在线状态](./RongCloud/Lib/User/Onlinestatus/OnlineStatus.php) | onlinestatus.check | 检查用户在线状态| 3.0.1 |
| [黑名单](./RongCloud/Lib/User/Blacklist/Blacklist.php) | blacklist.add | 添加黑名单 | 3.0.1 |
|  | blacklist.getList | 获取黑名单列表| 3.0.1 |
|  | blacklist.remove | 移除黑名单 | 3.0.1 |
| [单聊消息白名单](./RongCloud/Lib/User/Whitelist/Whitelist.php) | whitelist.add | 添加白名单 | 3.0.2 |
|  | whitelist.getList | 获取白名单列表| 3.0.2 |
|  | whitelist.remove | 移除白名单 | 3.0.2 |
| [用户封禁](./RongCloud/Lib/User/Block/Block.php) | block.add |添加用户封禁 | 3.0.1 |
|  | block.getList| 获取用户封禁列表| 3.0.1 |
|  | block.remove| 移除用户封禁| 3.0.1 |
| [用户标签](./RongCloud/Lib/User/Tag/Tag.php) | tag.set | 添加用户标签 |  |
|  | tag.batchset | 批量添加用户标签 | 3.0.4 |
|  | tag.get | 获取用户标签 | 3.0.4 |
| [用户全局群禁言](./RongCloud/Lib/User/MuteGroups/MuteGroups.php) | muteGroups.add | 添加全局群组禁言用户，添加后用户在应用下的所有群组中都不能发送消息 | 3.0.2 |
|  | muteGroups.remove | 移除全局群组禁言用户 | 3.0.2 |
|  | muteGroups.getList | 获取全局群组禁言用户列表 | 3.0.2 |
| [用户全局聊天室禁言](./RongCloud/Lib/User/MuteChatrooms/MuteChatrooms.php) | muteChatrooms.add | 添加全局聊天室禁言用户，添加后用户在应用下的所有聊天室中都不能发送消息 | 3.0.2 |
|  |muteChatrooms.remove |移除全局聊天室禁言用户| 3.0.2 |
|  |muteChatrooms.getList |获取全局聊天室禁言用户列表| 3.0.2 |
| [用户单聊禁言](./RongCloud/Lib/User/Chat/Ban.php) | ban.set | 设置用户禁言 | 3.0.14 |
|  | ban.getList | 查询禁言用户列表| 3.0.14 |
| [敏感词](./RongCloud/Lib/Sensitive/Sensitive.php) | add | 添加敏感词，添加后默认 2 小时生效| 3.0.1 |
|  | getList | 获取敏感词列表 | 3.0.1 |
|  | remove | 移除敏感词，支持批量移除功能，移除后默认 2 小时生效 | 3.0.1 |
| [单聊消息](./RongCloud/Lib/Message/Person/Person.php) | person.send | 发送单聊消息 | 3.0.1 |
|  | person.sendTemplate | 发送单聊模板消息 | 3.0.1 |
|  | person.sendStatusMessage | 发送单聊状态消息 | 3.0.6 |
|  | person.recall | 消息单聊撤回 | 3.0.1 |
| [聊天室消息](./RongCloud/Lib/Message/Chatroom/Chatroom.php)  | chatroom.send | 发送聊天室消息 | 3.0.1 |
|  | chatroom.broadcast| 发送聊天室广播消息 | 3.0.1 |
|  | chatroom.recall| 聊天室消息撤回 | 3.0.2 |
| [群组消息](./RongCloud/Lib/Message/Group/Group.php)  | group.send | 发送群组消息 | 3.0.1 |
|  | group.sendMention | 发送群组 @ 消息 | 3.0.1 |
|  | group.sendStatusMessage | 发送群组状态消息 | 3.0.6 |
|  | group.recall | 撤回群组消息 | 3.0.1 |
| [系统消息](./RongCloud/Lib/Message/System/System.php)  | system.send | 发送系统消息 | 3.0.1 |
|  | system.sendTemplate | 发送系统模板消息 | 3.0.1 |
|  | system.broadcast | 发送广播消息，单个应用每小时只能发送 2 次，每天最多发送 3 次。 | 3.0.1 |
|  | system.onlineBroadcast | 在线用户广播。 | 3.0.14 |
|  | system.pushUser | 不落地通知。 | 3.1.3 |
| [消息历史记录](./RongCloud/Lib/Message/History/History.php) | message.history.get | 消息历史记录下载地址获取 | 3.0.1 |
|  | message.history.remove | 消息历史记录删除方法 | 3.0.1 |
| [广播消息](./RongCloud/Lib/Push/Push.php) | push.push | 发送推送，推送和广播消息合计，单个应用每小时只能发送 2 次，每天最多发送 3 次。 | 3.0.4 |
|  | push.message | 发送广播消息，推送和广播消息合计，单个应用每小时只能发送 2 次，每天最多发送 3 次。 | 3.0.4 |
| [广播推送](./RongCloud/Lib/Message/Broadcast/Broadcast.php) | broadcast.recall | 广播消息撤回 | 3.0.1 |
| [群组](./RongCloud/Lib/Group/Group.php) | create | 创建群组 | 3.0.1 |
|  | sync | 同步群关系 | 3.0.1 |
|  | update | 更新群信息 | 3.0.1 |
|  | get | 获取群信息 | 3.0.1 |
|  | joins | 邀请人加入群组 | 3.0.1 |
|  | quit | 退出群组 | 3.0.1 |
|  | dismiss | 解散群组 | 3.0.1 |
| [用户指定群禁言](./RongCloud/Lib/group/Gag/Gag.php) | gag.add | 添加指定群组禁言用户，该用户在指定群组中不能发送消息 | 3.0.2 |
|  | gag.remove | 移除指定群组禁言用户 | 3.0.2 |
|  | gag.getList | 获取指定群组禁言用户列表 | 3.0.2 |
| [群禁言白名单](./RongCloud/Lib/group/MuteWhiteList/MuteWhiteList.php) | gag.add | 群组禁言白名单添加 | 3.0.3 |
|  | MuteWhiteList.remove | 移除群组禁言白名单 | 3.0.3 |
|  | MuteWhiteList.getList | 获取群组禁言白名单列表 | 3.0.3 |
| [用户指定群全部禁言](./RongCloud/Lib/group/MuteAllmembers/MuteAllmembers.php) | gag.add | 添加指定群组全部禁言| 3.0.3 |
|  | muteAllmembers.remove | 移除指定群组全部禁言 | 3.0.3 |
|  | muteAllmembers.getList | 获取指定群组全部禁言列表 | 3.0.3 |
| [会话免打扰(Conversation)](./RongCloud/Lib/Conversation/Conversation.php) | mute | 添加免打扰会话 | 3.0.1 |
|  | unMute | 移除免打扰会话 | 3.0.1 |
|  | get | 免打扰会话状态获取 | 3.0.1 |
| [聊天室](./RongCloud/Lib/Chatroom/Chatroom.php) | create | 创建聊天室 | 3.0.1 |
|  | destroy | 销毁聊天室 | 3.0.1 |
|  | get | 查询聊天室信息 | 3.0.1 |
|  | isExist | 检查用户是否在聊天室 | 3.0.1 |
| [聊天室封禁](./RongCloud/Lib/Chatroom/Block/Block.php) | block.add | 添加聊天室封禁用户，被封禁后用户无法加入该聊天室，如用户正在聊天室中将被踢出聊天室 | 3.0.1 |
|  | block.getList | 获取聊天室封禁用户列表 | 3.0.1 |
|  | block.remove | 移除聊天室封禁用户 | 3.0.1 |
| [聊天室全局禁言](./RongCloud/Lib/Chatroom/Ban/Ban.php) | ban.add | 添加聊天室禁言用户，用户无法在该聊天室中发送消息 | 3.0.2 |
|  | ban.getList | 获取聊天室禁言用户列表 | 3.0.2 |
|  | ban.remove | 移除聊天室禁言用户 | 3.0.2 |
| [聊天室成员禁言](./RongCloud/Lib/Chatroom/Gag/Gag.php) | gag.add | 添加聊天室禁言用户，用户无法在该聊天室中发送消息 | 3.0.2 |
|  | gag.getList | 获取聊天室禁言用户列表 | 3.0.2 |
|  | gag.remove | 移除聊天室禁言用户 | 3.0.2 |
| [聊天室消息优先级](./RongCloud/Lib/Chatroom/Demotion/Demotion.php) | demotion.add | 添加聊天室低优先级消息，添加后因消息量激增导致服务器压力较大时，默认丢弃低级别的消息 | 3.0.1 |
|  |demotion.getList|查询聊天室低优先级消息列表 | 3.0.1 |
|  |demotion.remove|移除聊天室低优先级消息 | 3.0.1 |
| [聊天室消息分发控制](./RongCloud/Lib/Chatroom/Distribute/Distribute.php) | distribute.stop | 停止聊天室消息分发，服务端收到上行消息后不进行下行发送 | 3.0.1 |
|  |distribute.resume|恢复聊天室消息分发| 3.0.1 |
| [聊天室保活](./RongCloud/Lib/Chatroom/Keepalive/Keepalive.php) | keepalive.add | 添加保活聊天室，保活中的聊天室不会被自动销毁 | 3.0.1 |
|  | keepalive.remove | 移除保活聊天室 | 3.0.1 |
|  | keepalive.getList | 获取保活聊天室列表 | 3.0.1 |
| [聊天室消息白名单](./RongCloud/Lib/Chatroom/Whitelist/Messages.php) | whiteList.message.add | 添加白名单消息类型，白名单中的消息类型，在消息量激增导致服务器压力较大时不会被丢弃，确保消息到达 | 3.0.1 |
|  | whiteList.message.remove | 移除白名单消息类型 | 3.0.1 |
|  | whiteList.message.getList | 获取白名单消息类型列表 | 3.0.1 |
| [聊天室用户白名单](./RongCloud/Lib/Chatroom/Whitelist/User.php) | whiteList.user.add | 添加白名单用户，白名单中用户发送的消息，在消息量激增导致服务器压力较大时不会被丢弃，确保消息到达 | 3.0.1 |
|  | whiteList.user.remove | 移除白名单用户 | 3.0.1 |
|  | whiteList.user.getList | 获取白名单用户列表 | 3.0.1 |
| [聊天室属性](./RongCloud/Lib/Chatroom/Entry/Entry.php) | Entry.set | 为指定聊天室以 Key、Value 方式自定义设置属性信息，此服务需要在开发者后台开通 IM 商用版后，开通使用。 | 3.0.6 |
|  | Entry.remove | 删除聊天室属性 | 3.0.6 |
|  | Entry.query | 获取聊天室属性 | 3.0.6 |
| [消息扩展](./RongCloud/Lib/Message/Expansion/Expansion.php) | Expansion.set | 发送消息时，如设置了 expansion 为 true，可对该条消息进行扩展信息设置，每次最多可以设置 100 个扩展属性信息，最多可设置 300 个。| 3.0.17 |
|  | Expansion.delete | 删除消息扩展 | 3.0.17 |
|  | Expansion.getList | 获取扩展信息 | 3.0.17 |
| [用户推送备注](./RongCloud/Lib/User/Remark/Remark.php) | Remark.set | 用户推送备注设置 | 3.1.2 |
|  | Entry.del | 用户推送备注删除 | 3.1.2 |
|  | Entry.get | 用户推送备注获取 | 3.1.2 |
| [群组推送备注](./RongCloud/Lib/Group/Remark/Remark.php) | Remark.set | 群组推送备注设置 | 3.1.2 |
|  | Entry.del | 群组推送备注删除 | 3.1.2 |
|  | Entry.get | 群组推送备注获取 | 3.1.2 |
| [消息扩展](./RongCloud/Lib/Message/Expansion/Expansion.php) | Expansion.set | 发送消息时，如设置了 expansion 为 true，可对该条消息进行扩展信息设置，每次最多可以设置 100 个扩展属性信息，最多可设置 300 个。| 3.0.17 |
|  | Expansion.delete | 删除消息扩展 | 3.0.17 |
|  | Expansion.getList | 获取扩展信息 | 3.0.17 |
| [超级群消息扩展](./RongCloud/Lib/Ultragroup/Expansion/Expansion.php) | Expansion.set | 发送超级群消息时，如设置了 expansion 为 true，可对该条消息进行扩展信息设置，每次最多可以设置 100 个扩展属性信息，最多可设置 300 个。| 3.1.2 |
|  | Expansion.delete | 删除消息扩展 | 3.1.2 |
|  | Expansion.getList | 获取扩展信息 | 3.1.2 |