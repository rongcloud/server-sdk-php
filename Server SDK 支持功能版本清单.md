Server SDK Feature Supported Version List

| Module | Method Name | Description | Supported Versions (Tags) |
| :----- | :---------- | :---------- | :------------------------ |
| [User Information](./RongCloud/Lib/User/User.php) | register | Register user and obtain token | 3.0.1 |
|  | update | Update user information | 3.0.1 |
|  | get | Get user information | 3.0.7 |
|  | getGroups | Query user's groups | 3.0.12 |
|  | expire | Token invalidation | 3.0.14 |
|  | reactivate | Reactivate user ID | 3.2.3 |
| [Check User Online Status](./RongCloud/Lib/User/Onlinestatus/OnlineStatus.php) | onlinestatus.check | Check user online status | 3.0.1 |
| [Blocklist](./RongCloud/Lib/User/Blacklist/Blacklist.php) | blacklist.add | Add to blocklist | 3.0.1 |
|  | blacklist.getList | Get blocklist | 3.0.1 |
|  | blacklist.remove | Remove from blocklist | 3.0.1 |
| [One-to-One Chat Whitelist](./RongCloud/Lib/User/Whitelist/Whitelist.php) | whitelist.add | Add to whitelist | 3.0.2 |
|  | whitelist.getList | Get whitelist | 3.0.2 |
|  | whitelist.remove | Remove from whitelist | 3.0.2 |
| [User Block](./RongCloud/Lib/User/Block/Block.php) | block.add | Block user | 3.0.1 |
|  | block.getList | Get blocked users | 3.0.1 |
|  | block.remove | Unblock user | 3.0.1 |
| [User Tags](./RongCloud/Lib/User/Tag/Tag.php) | tag.set | Add user tag | 3.0.4 |
|  | tag.batchset | Batch add user tags | 3.0.4 |
|  | tag.get | Get user tags | 3.0.4 |
| [User Hosting](./RongCloud/Lib/User/Profile/Profile.php) | profile.set | Set user profile | 3.2.7 |
|  | profile.clean | Clear hosted user info | 3.2.7 |
|  | profile.batchQuery | Batch query user profiles | 3.2.7 |
|  | profile.query | Paginated retrieval of all users | 3.2.7 |
| [Global Group Mute](./RongCloud/Lib/User/MuteGroups/MuteGroups.php) | muteGroups.add | Add global group mute | 3.0.2 |
|  | muteGroups.remove | Remove global group mute | 3.0.2 |
|  | muteGroups.getList | Get global group mute list | 3.0.2 |
| [Global Chatroom Mute](./RongCloud/Lib/User/MuteChatrooms/MuteChatrooms.php) | muteChatrooms.add | Add global chatroom mute | 3.0.2 |
|  | muteChatrooms.remove | Remove global chatroom mute | 3.0.2 |
|  | muteChatrooms.getList | Get global chatroom mute list | 3.0.2 |
| [One-to-One Chat Ban](./RongCloud/Lib/User/Chat/Ban.php) | ban.set | Set user ban | 3.0.14 |
|  | ban.getList | Get banned users list | 3.0.14 |
| [Sensitive Words](./RongCloud/Lib/Sensitive/Sensitive.php) | add | Add sensitive word (takes effect in 2h) | 3.0.1 |
|  | batchAdd | Batch add sensitive words | 3.2.6 |
|  | getList | Get sensitive words list | 3.0.1 |
|  | remove | Remove sensitive words (takes effect in 2h) | 3.0.1 |
| [One-to-One Chat Messages](./RongCloud/Lib/Message/Person/Person.php) | person.send | Send one-to-one message | 3.0.1 |
|  | person.sendTemplate | Send template message | 3.0.1 |
|  | person.sendStatusMessage | Send status message | 3.0.6 |
|  | person.recall | Recall message | 3.0.1 |
| [Chatroom Messages](./RongCloud/Lib/Message/Chatroom/Chatroom.php) | chatroom.send | Send chatroom message | 3.0.1 |
|  | chatroom.broadcast | Broadcast chatroom message | 3.0.1 |
|  | chatroom.recall | Recall chatroom message | 3.0.2 |
| [Group Messages](./RongCloud/Lib/Message/Group/Group.php) | group.send | Send group message | 3.0.1 |
|  | group.sendMention | Send group @message | 3.0.1 |
|  | group.sendStatusMessage | Send group status message | 3.0.6 |
|  | group.recall | Recall group message | 3.0.1 |
| [System Messages](./RongCloud/Lib/Message/System/System.php) | system.send | Send system message | 3.0.1 |
|  | system.sendTemplate | Send system template message | 3.0.1 |
|  | system.broadcast | Broadcast message (max 2/hr, 3/day) | 3.0.1 |
|  | system.onlineBroadcast | Broadcast to online users | 3.0.14 |
|  | system.pushUser | Push-only notification | 3.1.3 |
| [Message History](./RongCloud/Lib/Message/History/History.php) | message.history.get | Get message history URL | 3.0.1 |
|  | message.history.remove | Delete message history | 3.0.1 |
| [Broadcast Messages](./RongCloud/Lib/Push/Push.php) | push.push | Send push notification | 3.0.4 |
|  | push.message | Send broadcast message | 3.0.4 |
| [Broadcast Recall](./RongCloud/Lib/Message/Broadcast/Broadcast.php) | broadcast.recall | Recall broadcast message | 3.0.1 |
| [Groups](./RongCloud/Lib/Group/Group.php) | create | Create group | 3.0.1 |
|  | sync | Sync group relations | 3.0.1 |
|  | update | Update group info | 3.0.1 |
|  | get | Get group info | 3.0.1 |
|  | joins | Invite to group | 3.0.1 |
|  | quit | Leave group | 3.0.1 |
|  | dismiss | Dismiss group | 3.0.1 |
| [Group Mute](./RongCloud/Lib/group/Gag/Gag.php) | gag.add | Add group mute | 3.0.2 |
|  | gag.remove | Remove group mute | 3.0.2 |
|  | gag.getList | Get group mute list | 3.0.2 |
| [Group Mute Whitelist](./RongCloud/Lib/group/MuteWhiteList/MuteWhiteList.php) | gag.add | Add mute whitelist | 3.0.3 |
|  | MuteWhiteList.remove | Remove mute whitelist | 3.0.3 |
|  | MuteWhiteList.getList | Get mute whitelist | 3.0.3 |
| [Group-wide Mute](./RongCloud/Lib/group/MuteAllmembers/MuteAllmembers.php) | gag.add | Enable group-wide mute | 3.0.3 |
|  | muteAllmembers.remove | Disable group-wide mute | 3.0.3 |
|  | muteAllmembers.getList | Get group-wide mute status | 3.0.3 |
| [Group Hosting](./RongCloud/Lib/Entrust/Entrust.php) | Group.create | Create group | 3.2.8 |
|  | Group.update | Update group profile | 3.2.8 |
|  | Group.quit | Leave group | 3.2.8 |
|  | Group.dismiss | Dismiss group | 3.2.8 |
|  | Group.join | Join group | 3.2.8 |
|  | Group.transferOwner | Transfer group ownership | 3.2.8 |
|  | Group.import | Import hosted groups | 3.2.8 |
|  | Group.query | Paginated group query | 3.2.8 |
|  | Group.joinedQuery | Query user's groups | 3.2.8 |
|  | Group.profileQuery | Batch group profile query | 3.2.8 |
|  | GroupManager.add | Add group admin | 3.2.8 |
|  | GroupManager.remove | Remove group admin | 3.2.8 |
|  | GroupMember.set | Set member profile | 3.2.8 |
|  | GroupMember.kick | Remove member | 3.2.8 |
|  | GroupMember.kickAll | Remove user from all groups | 3.2.8 |
|  | GroupMember.follow | Set special attention member | 3.2.8 |
|  | GroupMember.unFollow | Remove special attention member | 3.2.8 |
|  | GroupMember.getFollowed | Get special attention list | 3.2.8 |
|  | GroupMember.query | Paginated member query | 3.2.8 |
|  | GroupMember.specificQuery | Get specific member info | 3.2.8 |
|  | GroupRemarkName.set | Set group remark name | 3.2.8 |
|  | GroupRemarkName.delete | Delete group remark name | 3.2.8 |
|  | GroupRemarkName.query | Query group remark name | 3.2.8 |
| [Conversation Do Not Disturb](./RongCloud/Lib/Conversation/Conversation.php) | mute | Add DND conversation | 3.0.1 |
|  | unMute | Remove DND conversation | 3.0.1 |
|  | get | Get DND status | 3.0.1 |
| [Chatrooms](./RongCloud/Lib/Chatroom/Chatroom.php) | create | Create chatroom | 3.0.1 |
|  | destroy | Destroy chatroom | 3.0.1 |
|  | query | Query chatroom info | 3.2.0 |
|  | get | Get chatroom members | 3.0.1 |
|  | isExist | Check user in chatroom | 3.0.1 |
| [Chatroom Block](./RongCloud/Lib/Chatroom/Block/Block.php) | block.add | Block user from chatroom | 3.0.1 |
|  | block.getList | Get blocked users list | 3.0.1 |
|  | block.remove | Unblock user | 3.0.1 |
| [Chatroom Mute](./RongCloud/Lib/Chatroom/Ban/Ban.php) | ban.add | Mute user in chatroom | 3.0.2 |
|  | ban.getList | Get muted users list | 3.0.2 |
|  | ban.remove | Unmute user | 3.0.2 |
| [Chatroom Gag](./RongCloud/Lib/Chatroom/Gag/Gag.php) | gag.add | Gag user in chatroom | 3.0.2 |
|  | gag.getList | Get gagged users list | 3.0.2 |
|  | gag.remove | Remove gag | 3.0.2 |
| [Message Priority](./RongCloud/Lib/Chatroom/Demotion/Demotion.php) | demotion.add | Add low-priority message type | 3.0.1 |
|  | demotion.getList | Get low-priority messages | 3.0.1 |
|  | demotion.remove | Remove low-priority type | 3.0.1 |
| [Message Distribution Control](./RongCloud/Lib/Chatroom/Distribute/Distribute.php) | distribute.stop | Stop message distribution | 3.0.1 |
|  | distribute.resume | Resume message distribution | 3.0.1 |
| [Chatroom Keepalive](./RongCloud/Lib/Chatroom/Keepalive/Keepalive.php) | keepalive.add | Add keepalive chatroom | 3.0.1 |
|  | keepalive.remove | Remove keepalive | 3.0.1 |
|  | keepalive.getList | Get keepalive list | 3.0.1 |
| [Message Whitelist](./RongCloud/Lib/Chatroom/Whitelist/Messages.php) | whiteList.message.add | Add message whitelist | 3.0.1 |
|  | whiteList.message.remove | Remove message whitelist | 3.0.1 |
|  | whiteList.message.getList | Get message whitelist | 3.0.1 |
| [User Whitelist](./RongCloud/Lib/Chatroom/Whitelist/User.php) | whiteList.user.add | Add user whitelist | 3.0.1 |
|  | whiteList.user.remove | Remove user whitelist | 3.0.1 |
|  | whiteList.user.getList | Get user whitelist | 3.0.1 |
| [Chatroom Attributes](./RongCloud/Lib/Chatroom/Entry/Entry.php) | Entry.set | Set chatroom attributes | 3.0.6 |
|  | Entry.remove | Remove chatroom attributes | 3.0.6 |
|  | Entry.query | Query chatroom attributes | 3.0.6 |
| [Message Extension](./RongCloud/Lib/Message/Expansion/Expansion.php) | Expansion.set | Set message extensions | 3.0.17 |
|  | Expansion.delete | Delete message extensions | 3.0.17 |
|  | Expansion.getList | Get message extensions | 3.0.17 |
| [User Push Remarks](./RongCloud/Lib/User/Remark/Remark.php) | Remark.set | Set push remark | 3.1.2 |
|  | Entry.del | Delete push remark | 3.1.2 |
|  | Entry.get | Get push remark | 3.1.2 |
| [Group Push Remarks](./RongCloud/Lib/Group/Remark/Remark.php) | Remark.set | Set group push remark | 3.1.2 |
|  | Entry.del | Delete group push remark | 3.1.2 |
|  | Entry.get | Get group push remark | 3.1.2 |
| [Ultragroup Message Extension](./RongCloud/Lib/Ultragroup/Expansion/Expansion.php) | Expansion.set | Set ultragroup message extensions | 3.1.2 |
|  | Expansion.delete | Delete ultragroup extensions | 3.1.2 |
|  | Expansion.getList | Get ultragroup extensions | 3.1.2 |