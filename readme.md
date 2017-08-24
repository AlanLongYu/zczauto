```
sequenceDiagram



PC->>贸易:摘单等动作 
贸易->>htApi:增加合同（contract/add_contract） 
htApi->>contractDb:写入数据
contractDb->>pushApi:pushApi查找未签合同 
pushApi->>up: makecontract 合同
up->>up: contract_tpl.php 
up->>htApi: /contract/fetch_tpl 生成合同模板 
htApi->>up: 合同内容html
up->>up:生成pdf
up->>PC:下载 
PC->>PC:盖第一个章
PC->>htApi:上传合同,contract/save_contract
htApi->>up:savecontract.php上传合同
up->>PC:download
PC->>PC:盖第二个章
PC->>htApi:上传合同,contract/save_contract
```