import { DisableKey } from './disable_key/index.js';
import { ListErrorAlert } from './list_error_alert/index.js';
import { PaddingCode } from './padding_code/index.js';
import { Smm, ItemSearch } from './search_master_modal/index.js';
import { SelectImage } from './select_image/index.js';
import { Sidemenu } from './sidemenu/index.js';
import { Unsaved } from './unsaved_alert/index.js';
import { AlertMsg, FilterTable, LimitLength, Util } from './update_dom/index.js';

Smm.start();
Unsaved.start();
DisableKey.start();
FilterTable.start();
LimitLength.start();
ListErrorAlert.start();
SelectImage.start();
PaddingCode.start();
Sidemenu.start();

window.AlertMsg = AlertMsg;
window.Unsaved = Unsaved;
window.Util = Util;
window.ItemSearch = ItemSearch;

// 環境指定
window.Environment = 'dev';
// window.Environment = 'prod';