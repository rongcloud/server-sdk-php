Server SDK Feature Supported Version List

| Module | Method Name | Description | Supported Versions (Tags) |
| :----- | :----- | :------ | :----- |
| [User Info](./RongCloud/Lib/User/User.php) | register | Register, get token | 3.0.1 |
|  | update | Update user info | 3.0.1 |
|  | get | Get user info | 3.0.7 |
|  | getGroups | Query user's groups | 3.0.12 |
|  | expire | Token expiration | 3.0.14 |
|  | reactivate | Reactivate user ID | 3.2.3 |
| [Check User Online Status](./RongCloud/Lib/User/Onlinestatus/OnlineStatus.php) | onlinestatus.check | Check user online status | 3.0.1 |
| [blocklist](./RongCloud/Lib/User/Blacklist/Blacklist.php) | blacklist.add | Add to blacklist | 3.0.1 |
|  | blacklist.getList | Get blacklist | 3.0.1 |
|  | blacklist.remove | Remove from blacklist | 3.0.1 |
| [Single Chat Whitelist](./RongCloud/Lib/User/Whitelist/Whitelist.php) | whitelist.add | Add to whitelist | 3.0.2 |
|  | whitelist.getList | Get whitelist | 3.0.2 |
|  | whitelist.remove | Remove from whitelist | 3.0.2 |
| [User Block](./RongCloud/Lib/User/Block/Block.php) | block.add | Add user block | 3.0.1 |
|  | block.getList | Get user block list | 3.0.1 |
|  | block.remove | Remove user block | 3.0.1 |
| [User Tag](./RongCloud/Lib/User/Tag/Tag.php) | tag.set | Add user tag | 3.0.4 |
|  | tag.batchset | Batch add user tags | 3.0.4 |
|  | tag.get | Get user tags | 3.0.4 |
| [User Profile](./RongCloud/Lib/User/Profile/Profile.php) | profile.set | Set user profile | 3.2.7 |
|  | profile.clean | Clear user profile | 3.2.7 |
|  | profile.batchQuery | Batch query user profiles | 3.2.7 |
|  | profile.query | Paginate all user list | 3.2.7 |
| [User Global Group Mute](./RongCloud/Lib/User/MuteGroups/MuteGroups.php) | muteGroups.add | Add global group mute user, after adding, the user cannot send messages in all groups under the app | 3.0.2 |
|  | muteGroups.remove | Remove global group mute user | 3.0.2 |
|  | muteGroups.getList | Get global group mute user list | 3.0.2 |
| [User Global Chatroom Mute](./RongCloud/Lib/User/MuteChatrooms/MuteChatrooms.php) | muteChatrooms.add | Add global chatroom mute user, after adding, the user cannot send messages in all chatrooms under the app | 3.0.2 |
|  | muteChatrooms.remove | Remove global chatroom mute user | 3.0.2 |
|  | muteChatrooms.getList | Get global chatroom mute user list | 3.0.2 |
| [User Single Chat Mute](./RongCloud/Lib/User/Chat/Ban.php) | ban.set | Set user mute | 3.0.14 |
|  | ban.getList | Query mute user list | 3.0.14 |
| [Sensitive Words](./RongCloud/Lib/Sensitive/Sensitive.php) | add | Add sensitive word, takes effect after 2 hours by default | 3.0.1 |
|  | batchAdd | Batch add sensitive words | 3.2.6 |
|  | getList | Get sensitive word list | 3.0.1 |
|  | remove | Remove sensitive word, supports batch removal, takes effect after 2 hours by default | 3.0.1 |
| [Single Chat Message](./RongCloud/Lib/Message/Person/Person.php) | person.send | Send single chat message | 3.0.1 |
|  | person.sendTemplate | Send single chat template message | 3.0.1 |
|  | person.sendStatusMessage | Send single chat status message | 3.0.6 |
|  | person.recall | Recall single chat message | 3.0.1 |
| [Chatroom Message](./RongCloud/Lib/Message/Chatroom/Chatroom.php) | chatroom.send | Send chatroom message | 3.0.1 |
|  | chatroom.broadcast | Send chatroom broadcast message | 3.0.1 |
|  | chatroom.recall | Recall chatroom message | 3.0.2 |
| [Group Message](./RongCloud/Lib/Message/Group/Group.php) | group.send | Send group message | 3.0.1 |
|  | group.sendMention | Send group @ message | 3.0.1 |
|  | group.sendStatusMessage | Send group status message | 3.0.6 |
|  | group.recall | Recall group message | 3.0.1 |
| [system message](./RongCloud/Lib/Message/System/System.php) | system.send | Send system message | 3.0.1 |
|  | system.sendTemplate | Send system template message | 3.0.1 |
|  | system.broadcast | Send broadcast message, limited to 2 times per hour and 3 times per day per app | 3.0.1 |
|  | system.onlineBroadcast | Broadcast to online users | 3.0.14 |
|  | system.pushUser | Push-only Notification | 3.1.3 |
| [Message History](./RongCloud/Lib/Message/History/History.php) | message.history.get | Get message history download URL | 3.0.1 |
|  | message.history.remove | Delete message history | 3.0.1 |
| [Broadcast Message](./RongCloud/Lib/Push/Push.php) | push.push | Send push, combined with broadcast message, limited to 2 times per hour and 3 times per day per app | 3.0.4 |
|  | push.message | Send broadcast message, combined with push, limited to 2 times per hour and 3 times per day per app | 3.0.4 |
| [Broadcast Push](./RongCloud/Lib/Message/Broadcast/Broadcast.php) | broadcast.recall | Recall broadcast message | 3.0.1 |
| [group](./RongCloud/Lib/Group/Group.php) | create | Create group | 3.0.1 |
|  | sync | Sync group relationships | 3.0.1 |
|  | update | Update group info | 3.0.1 |
|  | get | Get group info | 3.0.1 |
|  | joins | Invite users to join group | 3.0.1 |
|  | quit | Quit group | 3.0.1 |
|  | dismiss | Dismiss group | 3.0.1 |
| [User Specific Group Mute](./RongCloud/Lib/group/Gag/Gag.php) | gag.add | Add specific group mute user, the user cannot send messages in the specified group | 3.0.2 |
|  | gag.remove | Remove specific group mute user | 3.0.2 |
|  | gag.getList | Get specific group mute user list | 3.0.2 |
| [Group Mute Whitelist](./RongCloud/Lib/group/MuteWhiteList/MuteWhiteList.php) | gag.add | Add group mute whitelist | 3.0.3 |
|  | MuteWhiteList.remove | Remove group mute whitelist | 3.0.3 |
|  | MuteWhiteList.getList | Get group mute whitelist list | 3.0.3 |
| [User Specific Group All Mute](./RongCloud/Lib/group/MuteAllmembers/MuteAllmembers.php) | gag.add | Add specific group all mute | 3.0.3 |
|  | muteAllmembers.remove | Remove specific group all mute | 3.0.3 |
|  | muteAllmembers.getList | Get specific group all mute list | 3.0.3 |
| [Group Profile](./RongCloud/Lib/Entrust/Entrust.php) | Group.create | Create group | 3.2.8 |
|  | Group.update | Set group profile | 3.2.8 |
|  | Group.quit | Quit group | 3.2.8 |
|  | Group.dismiss | Dismiss group | 3.2.8 |
|  | Group.join | Join group | 3.2.8 |
|  | Group.transferOwner | Transfer group ownership | 3.2.8 |
|  | Group.import | Import group profile | 3.2.8 |
|  | Group.query | Paginate group info under app | 3.2.8 |
|  | Group.joinedQuery | Paginate user's joined groups | 3.2.8 |
|  | Group.profileQuery | Batch query group profiles | 3.2.8 |
|  | GroupManager.add | Set group admin (add group admin) | 极光 Server SDK 功能支持的版本清单

| 模块   | 方法名    | 说明           | 支持版本（Tags）   |
| :-----| :-----  | :------ | :----- |
| [用户信息](./RongCloud/Lib/User/User.php) | register | 注册， 获取 token| 3.0.1 |
|  | update | 更新用户信息 | 3.0.1 |
|  | get | 获取用户信息 | 3.0.7 |
|  | getGroups | 查询用户所在群组 | 3.0.12 |
|  | expire | Token 失效 | 3.0.14 |
|  | reactivate | 重新激活用户 ID | 3.2.3 |
| [检查用户在线状态](./RongCloud/Lib/User/Onlinestatus/OnlineStatus.php) | onlinestatus.check | 检查用户在线状态| 极光 Server SDK 功能支持的版本清单

| 模块   | 方法名    | 说明           | 支持版本（Tags）   |
| :-----| :-----  | :------ | :----- |
| [用户信息](./RongCloud/Lib/User/User.php) | register | 注册， 获取 token| 3.0.1 |
|  | update | 更新用户信息 | 3.极光 Server SDK 功能支持的版本清单

| 模块   | 方法名    | 说明           | 支持版本（Tags）   |
| :-----| :-----  | :------ | :----- |
| [用户信息](./RongCloud/Lib/User/User.php) | register | 注册， 获取 token| 3.0.1 |
|  | update | 更新用户信息 | 3.0.1 |
|  | get | 获取用户信息 | 3.0.7 |
|  | getGroups | 查询用户所在群组 | 3.0.12 |
|  | expire | Token 失效 | 3.0.14 |
|  | reactivate | 重新激活用户 ID | 3.2.3 |
| [检查用户在线状态](./RongCloud/Lib/User/Onlinestatus/OnlineStatus.php) | onlinestatus.check | 检查用户在线状态| 3.0.1 |
| [blocklist](./RongCloud/Lib/User/Blacklist/Blacklist.php) | blacklist.add | 添加黑名单 | 3.0.1 |
|  | blacklist.getList | 获取黑名单列表| 3.0.1 |
|  | blacklist.remove | 移除黑名单 | 3.0.1 |
| [单聊消息白名单](./RongCloud/L极光 Server SDK 功能支持的版本清单

| 模块   | 方法名    | 说明           | 支持版本（Tags）   |
| :-----| :-----  | :------ | :----- |
| [用户信息](./RongCloud/Lib/User/极光 Server SDK 功能支持的版本清单

| 模块   | 方法名    | 说明           | 支持版本（Tags）   |
| :-----| :-----  | :------ | :----- |
| [用户信息](./RongCloud/Lib/User/User.php) | register | 注册， 获取 token| 3.0.1 |
|  | update | 更新用户信息 | 3.0.1 |
|  | get | 获取用户信息 | 3.0.7 |
|  | getGroups | 查询用户所在群组 | 3.0.12 |
|  | expire | Token 失效 | 3.0.14 |
|  | reactivate | 重新激活用户 ID | 3.2.3 |
| [检查用户在线状态](./RongCloud/Lib/User/Onlinestatus/OnlineStatus.php) | onlinestatus.check | 检查用户在线状态| 3.0.1 |
| [blocklist](./RongCloud/Lib/User/Blacklist/Blacklist.php) | blacklist.add | 添加黑名单 | 3.0.1 |
|  | blacklist.getList | 获取黑名单列表| 3.0.1 |
|  | blacklist.remove | 移除黑名单 | 3.0.1 |
| [单聊消息白名单](./RongCloud/Lib/User/Whitelist/Whitelist.php) | whitelist.add | 添加白名单 | 3.0.2 |
|  | whitelist.getList | 获取白名单列表| 3.0.2 |
|  | whitelist.remove | 移除白名单 | 3.0.2 |
| [用户封禁](./RongCloud/Lib/User/Block/Block.php) | block.add |添加用户封禁 | 3.0.1 |
|  | block.getList| 获取用户封禁列表| 3.0.1 |
|  | block.remove| 移除用户封禁| 3.0.1 |
| [用户标签](./RongCloud/Lib/User/Tag/Tag.php) | tag.set | 添加用户标签 | 3.0.4 |
|  | tag.batchset | 批量添加用户标签 | 3极光 Server SDK 功能支持的版本清单

| 模块   | 方法名    | 说明           | 支持版本（Tags）   |
| :-----| :-----  | :------ | :----- |
| [用户信息](./RongCloud/Lib/User/User.php) | register | 注册， 获取 token| 3.0.1 |
|  | update | 更新用户信息 | 3.0.1 |
|  | get | 获取用户信息 | 3.0.7 |
|  | getGroups | 查询用户所在群组 | 3.0.12 |
|  | expire | Token 失效 | 3.0.14 |
|  | reactivate | 重新激活用户 ID | 3.2.3 |
| [检查用户在线状态](./RongCloud/Lib/User/Onlinestatus/OnlineStatus.php) | onlinestatus.check | 检查用户在线状态| 3.0.1 |
| [blocklist](./RongCloud/Lib/User/Blacklist/Blacklist.php) | blacklist.add | 添加黑名单 | 3.0.1 |
|  | blacklist.getList | 获取黑名单列表| 3.0.1 |
|  | blacklist.remove | 移除黑名单 | 3.0.1 |
| [单聊消息白名单](./RongCloud/Lib/User/Whitelist/Whitelist.php) | whitelist.add | 添加白名单 | 3.0.2 |
|  | whitelist.getList | 获取白名单列表| 3.0.2 |
|  | whitelist.remove | 移除白名单 | 3.0.2 |
| [用户封禁](./RongCloud/Lib/User/Block/Block.php) | block.add |添加用户封禁 | 3.0.1 |
|  | block.getList| 获取用户封禁列表| 3.0.1 |
|  | block.remove| 移除用户封禁| 3.0.1 |
| [用户标签](./RongCloud/Lib/User/Tag/Tag.php) | tag.set | 添加用户标签 | 3.0.4 |
|  | tag.batchset | 批量添加用户标签 | 3.0.4 |
|  | tag.get | 获取用户标签 | 3.0.4 |
| [用户托管](./RongCloud/Lib/User/Profile/Profile.php) | profile.set | 用户资料设置 | 3.2.7 |
|  | profile.clean | 用户托管信息清除 | 3.2.7 |
|  | profile.batchQuery | 批量查询用户资料 | 3.2.7 |
|  | profile.query | 分页获取应用全部用户列表 | 3.2.7 |
| [用户全局群禁言](./RongCloud/Lib/User/MuteGroups/MuteGroups.php) | muteGroups.add | 添加全局群组禁言用户，添加后用户在应用下的所有群组中都不能发送消息 | 3.0.2 |
|  | muteGroups.remove | 移除全局群组禁言用户 | 3.极光 Server SDK 功能支持的版本清单

| 模块   | 方法名    | 说明           | 支持版本（Tags）   |
| :-----| :-----  | :------ | :----- |
| [用户信息](./RongCloud/Lib/User/User.php) | register | 注册， 获取 token| 3.0.1 |
|  | update | 更新用户信息 | 3.0.1 |
|  | get | 获取用户信息 |