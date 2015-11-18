lib.fluidContent {
	templateRootPaths >
	templateRootPaths {
		0 = EXT:fluid_styled_content/Resources/Private/Templates/Content/
		10 = {$page.includePath.privateResources}Templates/Extensions/FluidStyledContent/Content/
	}
	partialRootPaths >
	partialRootPaths {
		0 = EXT:fluid_styled_content/Resources/Private/Partials/
		10 = EXT:{$page.includePath.privateResources}Partials/Extensions/FluidStyledContent/
	}
	layoutRootPaths >
	layoutRootPaths {
		0 = EXT:fluid_styled_content/Resources/Private/Layouts/
		10 = EXT:{$page.includePath.privateResources}Layouts/Extensions/FluidStyledContent/
	}
}