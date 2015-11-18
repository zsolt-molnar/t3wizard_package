Ext.onReady(function() {
	Ext.apply(TYPO3.Components.PageTree.Actions, {
		clearPageCache: function(node, tree) {
			TYPO3.T3wizard.ClickmenuAction.clearPageCache(
				node.attributes.nodeData,
				function(response) {
					if (response === true) {
						TYPO3.Flashmessage.display(TYPO3.Severity.ok, '', TYPO3.lang.t3wizard_clearPageCacheSuccess);
					} else {
						TYPO3.Flashmessage.display(TYPO3.Severity.error, '', TYPO3.lang.t3wizard_clearPageCacheError);
					}
				},
				this
			);
		}
	});
	Ext.apply(TYPO3.Components.PageTree.Actions, {
		clearBranchCache: function(node, tree) {
			TYPO3.T3wizard.ClickmenuAction.clearBranchCache(
				node.attributes.nodeData,
				function(response) {
					if (response === true) {
						TYPO3.Flashmessage.display(TYPO3.Severity.ok, '', TYPO3.lang.t3wizard_clearBranchCacheSuccess);
					} else {
						TYPO3.Flashmessage.display(TYPO3.Severity.error, '', TYPO3.lang.t3wizard_clearBranchCacheError);
					}
				},
				this
			);
		}
	});
	Ext.apply(TYPO3.Components.PageTree.Actions, {
		clearLangCache: function(node, tree) {
			TYPO3.T3wizard.ClickmenuAction.clearLangCache(
				node.attributes.nodeData,
				function(response) {
					if (response === true) {
						TYPO3.Flashmessage.display(TYPO3.Severity.ok, '', TYPO3.lang.t3wizard_clearCacheSuccess);
					} else {
						TYPO3.Flashmessage.display(TYPO3.Severity.error, '', TYPO3.lang.t3wizard_clearCacheError);
					}
				},
				this
			);
		}
	});	
	Ext.apply(TYPO3.Components.PageTree.Actions, {
		clearMediumCache: function(node, tree) {
			TYPO3.T3wizard.ClickmenuAction.clearMediumCache(
				node.attributes.nodeData,
				function(response) {
					if (response === true) {
						TYPO3.Flashmessage.display(TYPO3.Severity.ok, '', TYPO3.lang.t3wizard_clearCacheSuccess);
					} else {
						TYPO3.Flashmessage.display(TYPO3.Severity.error, '', TYPO3.lang.t3wizard_clearCacheError);
					}
				},
				this
			);
		}
	});	
	Ext.apply(TYPO3.Components.PageTree.Actions, {
		clearFullCache: function(node, tree) {
			TYPO3.T3wizard.ClickmenuAction.clearFullCache(
				node.attributes.nodeData,
				function(response) {
					if (response === true) {
						TYPO3.Flashmessage.display(TYPO3.Severity.ok, '', TYPO3.lang.t3wizard_clearCacheSuccess);
					} else {
						TYPO3.Flashmessage.display(TYPO3.Severity.error, '', TYPO3.lang.t3wizard_clearCacheError);
					}
				},
				this
			);
		}
	});		
});
