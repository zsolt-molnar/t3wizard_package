# Breadcrumb
# Breadcrumb for GA

lib.breadcrumb = COA
lib.breadcrumb {
	wrap = <ol class="breadcrumb">|</ol>
	5 = TEXT
	5 {
		#data = {$page.includePath.lang}locallang.xlf:misc.youAreHere
		#noTrimWrap = |<p id="breadcrumbLabel">|: </p>|
	}
	10 = COA
	10 {
		#wrap = <ol aria-labelledby="breadcrumbLabel">|</ol>
		10 = TEXT
		10 {
			data = {$page.includePath.lang}locallang.xlf:misc.home
			stdWrap.wrap = <span class="hover">|</span>
			typolink {
				wrap = <li>|</li>
				parameter = {$page.specialPages.home}
			}
		}
		20 = HMENU
		20 {
			special = rootline
			special.range = 1|-1
			includeNotInMenu = 1
			excludeDoktypes = 5
			1 = TMENU
			1 {
				noBlur = 1
				accessKey = 0
				NO.allWrap = <li>|</li>
				NO.stdWrap.wrap = <span class="hover">|</span>
				CUR = 1
				CUR {
					allWrap = <li title="{field:title}" class="active">|</li>
					allWrap.insertData = 1
					stdWrap.htmlSpecialChars = 0
					stdWrap.field = nav_title // title
					doNotLinkIt = 1
				}
			}
		}
	}
}

## Single news
[globalVar = GP:tx_news_pi1|news > 0] || [globalVar = GP:tx_news_pi1|news_preview > 0]
	lib.breadcrumb.10.20 {
		1.CUR >
		includeNotInMenu = 0
	}
	lib.breadcrumb.10.30 = RECORDS
	lib.breadcrumb.10.30 {
		dontCheckPid = 1
		tables = tx_news_domain_model_news
		source.data = GP:tx_news_pi1|news // GP:tx_news_pi1|news_preview
		conf.tx_news_domain_model_news = TEXT
		conf.tx_news_domain_model_news {
			field = title
			dataWrap = <li title="{field:title} ({LLL:EXT:{$stratis.var.pathLanguage}locallang_typoscript.xlf:menus.currentSection})">|</li>
		}
	}
[global]