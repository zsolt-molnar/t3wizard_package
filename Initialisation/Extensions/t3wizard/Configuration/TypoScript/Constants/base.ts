############
### PAGE ###
############
page {
    logo {
        # cat=t3wizard: basic/110/file; type=string; label=Logo: Leave blank to use website title from template instead
        file                            = EXT:t3wizard/Resources/Public/Images/FrontEnd/Logos/logo.png
        # cat=t3wizard: basic/110/height; type=int+; label=Height: The image will not be resized!
        height                          = 48
        # cat=t3wizard: basic/110/width; type=int+; label=Width: The image will not be resized!
        width                           = 350
    }

    fluidtemplate {
        # cat=t3wizard: advanced/100/100; type=string; label=Layout Root Path: Path to layouts
        layoutRootPath                  = EXT:t3wizard/Resources/Private/Layouts/Page/
        # cat=t3wizard: advanced/100/110; type=string; label=Partial Root Path: Path to partials
        partialRootPath                 = EXT:t3wizard/Resources/Private/Partials/Page/
        # cat=t3wizard: advanced/100/120; type=string; label=Template Root Path: Path to templates
        templateRootPath                = EXT:t3wizard/Resources/Private/Templates/Page/
    }
    includePath {
        # cat=t3wizard: advanced/130/100; type=string; label=Css Include Path: Path to css files
        css                             = EXT:t3wizard/Resources/Public/Css/
        # cat=t3wizard: advanced/130/110; type=string; label=Icon Include Path: Path to css files
        icons                           = EXT:t3wizard/Resources/Public/Icons/
        # cat=t3wizard: advanced/130/120; type=string; label=JavaScript Include Path: Path to css files
        javascript                      = EXT:t3wizard/Resources/Public/JavaScript/
		images                      	= EXT:t3wizard/Resources/Public/Images/
		imagesFull                      = typo3conf/ext/t3wizard/Resources/Public/Images/
		publicResources                 = EXT:t3wizard/Resources/Public/
		projectFolder					= WebSite/
		privateResources                = EXT:t3wizard/Resources/Private/
		lang                			= LLL:EXT:t3wizard/Resources/Private/Language/
    }
    meta {
        # cat=t3wizard: basic/120/100; type=string; label=Description: Enter a short description of the page. It will be displayed in the result lists of most search engines.
        description                     		=
        # cat=t3wizard: basic/120/110; type=string; label=Author: Enter the page author's name.
        author                          		=
        # cat=t3wizard: basic/120/120; type=string; label=Keywords: Enter keywords for the page separated by commas. You may also use short phrases.
        keywords                        		=
        # cat=t3wizard: advanced/120/100; type=string; label=viewport
        viewport                        		= width=device-width, initial-scale=1, maximum-scale=1
        # cat=t3wizard: advanced/120/110; type=string; label=robots
        robots                          		= index,follow
        # cat=t3wizard: advanced/120/120; type=string; label=apple-mobile-web-app-capable
        apple-mobile-web-app-capable    		= no
        # cat=t3wizard: advanced/120/130; type=string; label=compatible
        compatible                      		= IE=edge,chrome=1
        # cat=t3wizard: advanced/120/140; type=string; label=google
        google                          		= notranslate
		mobile-web-app-capable 					= yes
		apple-mobile-web-app-status-bar-style 	= black
		apple-mobile-web-app-title 				= SportDE_TV			
    }
    specialPages {
		home = 1
		homepageClass = 1|14|15
		topMenu = 18
		socialMenu = 21
		excludeFromHeader = 27
    }
	content {
		copyright = 2
		footerText = 20
		partners = 69
	}	
}

###############
### PLUGINS ###
###############
plugin.tx_femanager.persistence.storagePid = 5


##############
### CONFIG ###
##############
config {
    # cat=t3wizard: advanced/150/100; type=boolean; label=BaseURL: This will override the default automatic BaseURL determination
    baseURL								= 
    # cat=t3wizard: advanced/150/110; type=boolean; label=No Cache
    no_cache                            = 0
    # cat=t3wizard: advanced/150/120; type=boolean; label=Compress JavaScript
    compressJs                          = 0
    # cat=t3wizard: advanced/150/130; type=boolean; label=Compress Css
    compressCss                         = 0
    # cat=t3wizard: advanced/150/140; type=boolean; label=Concatenate JavaScript
    concatenateJs                       = 0
    # cat=t3wizard: advanced/150/150; type=boolean; label=Concatenate Css
    concatenateCss                      = 0
    # cat=t3wizard: advanced/150/160; type=text; label=Header Comment
    headerComment                       = T3Wizard by Moyo
}