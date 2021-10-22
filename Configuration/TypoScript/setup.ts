# Module configuration
module.tx_wpdeqarreports_web_wpdeqarreportsdeqar {
    persistence {
        storagePid = {$module.tx_wpdeqarreports_deqar.persistence.storagePid}
    }

    view {
        templateRootPaths.0 = EXT:{extension.extensionKey}/Resources/Private/Backend/Templates/
        templateRootPaths.1 = {$module.tx_wpdeqarreports_deqar.view.templateRootPath}
        partialRootPaths.0 = EXT:wp_deqar_reports/Resources/Private/Backend/Partials/
        partialRootPaths.1 = {$module.tx_wpdeqarreports_deqar.view.partialRootPath}
        layoutRootPaths.0 = EXT:wp_deqar_reports/Resources/Private/Backend/Layouts/
        layoutRootPaths.1 = {$module.tx_wpdeqarreports_deqar.view.layoutRootPath}
    }
}