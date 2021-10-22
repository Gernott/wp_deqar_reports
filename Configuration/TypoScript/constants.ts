module.tx_wpdeqarreports_deqar {
    view {
        # cat=module.tx_wpdeqarreports_deqar/file; type=string; label=Path to template root (BE)
        templateRootPath = EXT:wp_deqar_reports/Resources/Private/Backend/Templates/
        # cat=module.tx_wpdeqarreports_deqar/file; type=string; label=Path to template partials (BE)
        partialRootPath = EXT:wp_deqar_reports/Resources/Private/Backend/Partials/
        # cat=module.tx_wpdeqarreports_deqar/file; type=string; label=Path to template layouts (BE)
        layoutRootPath = EXT:wp_deqar_reports/Resources/Private/Backend/Layouts/
    }

    persistence {
        # cat=module.tx_wpdeqarreports_deqar//a; type=string; label=Default storage PID
        storagePid =
    }
}
