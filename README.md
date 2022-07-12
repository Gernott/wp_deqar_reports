
# TYPO3 extension `wp_deqar_reports`

This extension offers the possibility, to submit DEQAR reports (https://www.eqar.eu) directly from the TYPO3 Backend and show them on your website.

## Extension-Settings
Extension-Settings are set centralized for the whole TYPO3 installation.

### Basic settings

| Property                   | Type   | Example value                                                                                  | Description                                                              | Required |
|----------------------------|--------|------------------------------------------------------------------------------------------------|--------------------------------------------------------------------------|----------|
| authorization_token        | String | abc                                                                                            | DEQAR API Token                                                          | x        |
| report_submission_endpoint | String | https://backend.deqar.eu/submissionapi/v1/submit/report or: https://backend.sandbox.deqar.eu/… | DEQAR API URLCan be a sandbox URL too                                    | x        |
| date_format                | String | %Y-%m-%d                                                                                       | Date format for valid_* fields                                           | x        |
| report_languages           | String | ger, eng                                                                                       | comma separated list of available languages (3 letters) for report files |          |
| agency                     | String | EAEVE                                                                                          | Used for the Backend Listview, to filter the own reports                 |          |

### Property settings

Additionally, you can make settings for each property. The following table shows which properties combined with their prefix are available (x).
In the Backend, the properties are splitted in 3 own tabs called “Show properties”, “Submit properties” and “Prefill properties”.

| Property                        | Description                                                                                   | show_ | submit_ | prefill_ |
|---------------------------------|-----------------------------------------------------------------------------------------------|:-----:|:-------:|:--------:|
| type                            | This is a required field and has to be submitted                                              |   x   |         |     x    |
| agency                          |                                                                                               |   x   |    x    |     x    |
| local_identifier                | TYPO3 record uid is not an input field                                                        |       |    x    |          |
| activity                        |                                                                                               |   x   |    x    |     x    |
| activity_local_identifier       |                                                                                               |   x   |    x    |     x    |
| status                          | This is a required field and has to be submitted                                              |   x   |         |     x    |
| decision                        | This is a required field and will always be submitted and must be setted manually             |       |         |          |
| valid_from                      | This is a required field and will always be submitted and must be setted manually             |       |         |          |
| valid_to                        | This must be setted manually                                                                  |   x   |    x    |          |
| file_original_location          | This is a required field and will always be submitted and must be setted manually             |       |         |          |
| file_display_name               | This is a required field and will always be submitted and must be setted manually             |       |         |          |
| file_report_language            | This is a required field and has to be submitted                                              |   x   |         |     x    |
| ser_report_file                 | This is a local property and will not be submitted and must be setted manually                |   x   |         |          |
| ser_report_name                 | This is a local property and will not be submitted and must be setted manually                |   x   |         |          |
| institution_deqar_id            | This is a required field and has to be submitted                                              |   x   |         |     x    |
| programme_name_primary          | This is a required field and has to be submitted, but not in “Institutional reports”          |       |    x    |     x    |
| programme_identifier            |                                                                                               |   x   |    x    |     x    |
| programme_qualification_primary |                                                                                               |   x   |    x    |     x    |
| programme_nqf_level             |                                                                                               |   x   |    x    |     x    |
| programme_qf_ehea_level         |                                                                                               |   x   |    x    |     x    |
| hardcopy                        | This is a local property and will not be submitted.It is a Checkboy, so no prefill is needed. |   x   |         |          |

#### show_
- Type: Checkbox
- Example Fieldname: show_agency
- Example Label: Show agency
If activated, this property is displayed in the “List view” and “Upload form”.
By default, all show_* checkboxes are activated.

#### submit_
- Type: Checkbox
- Example Fieldname: submit_agency
- Example Label: Submit agency
If activated, this property will be transferred in the “Upload form”.
By default, all submit_* checkboxes are activated.

#### prefill_
- Type: Input field (string)
- Example Fieldname: prefill_agency
- Example Label: Prefill agency

Prefills the property with the given value.
By default, the fields are empty.
If show_ is activated for this property, the value of the “Upload form” is prefilled.
If show_ is deactivated for this property, the value is used hidden at the API transfer.
If both show_ and submit_ are deactivated, this value is obsolete.

Note: programme_* fields are in the Program Model, not Report.

## Module

### Introduction
The Extension exists of one Module. Modules are to be used in the TYPO3-Backend.
The Module calls the API using the Extension-Settings.

### List view
Basically, when opening the Module, this “List view” is shown. It shows a Button for uploading reports, a Year-filter for the list and a list of all existing records.
The year filter is showing all years from the oldest TYPO3-record (valid_from) to the current year. Initially the current year is activated.

Caution: Older entries from DEQAR (then the oldest TYPO3 record’s year) are not visible!

The list shows all records from TYPO3 and DEQAR! The list is filtered with the agency, given in the extension-settings. They are grouped by their ID (one line for a record in both systems). Usually the records in both systems are the same. But they can be different, if someone is uploading by hand in the DEQAR system or when they are uploaded into TYPO3 without transfer to DEQAR. In this case, data from TYPO3 is shown.

All properties (columns) from the extension-settings with disabled show_* property are not shown.

The table is sorted by date_from (ascending).

For valid_from and valid_to the date format from the extension settings is used.

The List view shows a table with a line for each record.

The following columns can be visible:

| Label                     | Property                                    | Example                              | Description                                                     |
|---------------------------|---------------------------------------------|--------------------------------------|-----------------------------------------------------------------|
| Type                      | type                                        | Institutional report                 | As an Icon with tooltipp                                        |
| TYPO3                     | -                                           | Yes or No                            | As an Icon.Yes, if stored in TYPO3.TYPO3’s uid as Tooltipp      |
| DEQAR                     | -                                           | Yes or No                            | As an Icon.Yes, if stored in DEQAR.local_identifier as Tooltipp |
| Agency                    | agency                                      | EAEVE                                |                                                                 |
| Activity                  | activity                                    | 273                                  | As Tooltipp the name of the activity                            |
| Activity local identifier | activity_local_identifier                   | 273                                  |                                                                 |
| Status                    | status                                      | 2                                    |                                                                 |
| Decision                  | decision                                    | Accreditation                        | The title of the Decision                                       |
| Valid from                | valid_from                                  | 04-03-2019                           | Format as set in Extension settings                             |
| Valid to                  | valid_to                                    | 04-03-2026                           | Format as set in Extension settings                             |
| File                      | file_display_name, file_original_location   | Full Visitation Report               | file_display_name is shown and links to file_original_location  |
| File report language      | file_report_language                        | eng                                  |                                                                 |
| SER file                  | ser_report_file, ser_report_nameor hardcopy | SER 1                                | ser_report_name is shown and links to ser_report_file           |
| Institution               | institution1_deqar_id + name                | University of Vienna (DEQARINST0784) |                                                                 |
| Programme identifier      | programme_identifier                        | 16                                   |                                                                 |
| Programme name primary    | programme_name_primary                      | Veterinary Medicine                  |                                                                 |
| Programme qualification   | programme_qualification_primary             | Master of Arts                       |                                                                 |
| Programme nqf level       | programme_nqf_level                         | level 7                              |                                                                 |
| Programme qf ehea level   | programme_qf_ehea_level                     | 2                                    |                                                                 |

Programs are a 1:n relation from reports. So more than one program can exist.

### Upload Form
The DEQAR-API allows you to send multiple reports in one call. But this module submits only one single report. The upload form can show the following formfields.

| Label                        | Property                        | Example                | Type       |
|------------------------------|---------------------------------|------------------------|------------|
| Transfer to DEQAR            | -                               | 1                      | Checkbox   |
| Type                         | type                            | 1                      | Select     |
| Agency                       | agency                          | EAEVE                  | String     |
| Local identifier (TYPO3 uid) | local_identifier                | 123                    | Integer    |
| Activity                     | activity                        | 273                    | Select     |
| Activity local identifier    | activity_local_identifier       | 273xy                  | String     |
| Status                       | status                          | 2                      | Select     |
| Decision                     | decision                        | 1                      | Select     |
| Valid from                   | valid_from                      | 04-03-2019             | Date       |
| Valid to                     | valid_to                        | 04-03-2026             | Date       |
| File label                   | file_display_name               | Full Visitation Report | String     |
| File path                    | file_original_location          |                        | File / FAL |
| File report language         | file_report_language            | eng                    | Select     |
| SER file path                | ser_report_file                 |                        | File / FAL |
| SER file label               | ser_report_name                 | Stage 1 SER            | String     |
| Institution                  | institution_deqar_id            | DEQARINST0784          | Select2    |
| Programme name primary       | programme_name_primary          | Veterinary Medicine    | String     |
| Programme identifier         | programme_identifier            | 16                     | Integer    |
| Programme qualification      | programme_qualification_primary | Master of Arts         | String     |
| Programme nqf level          | programme_nqf_level             | level 7                | String     |
| Programme qf ehea level      | programme_qf_ehea_level         | second cycle           | String     |
| Hardcopy                     | hardcopy                        | 0                      | Checkbox   |

The 5 programme_* fields can be added multiple (1:n relation). Respect the API, it can be required.

For valid_from and valid_to the date format from the extension settings is used.

All properties from the extension-settings with disabled show_* property is not shown.

If the Checkbox “Transfer to DEQAR” is activated, the API call is used. Otherwise only the TYPO3 record will be created. This Checkbox is activated by default.

#### Hardcopy
If active, “ser_report_file” is disabled.

Otherwise is “hardcopy” disabled, when “ser_report_file” is filled out.

#### Institution
The Institution select (Select2) is prefilled with values from the API: https://backend.deqar.eu/connectapi/v1/institutions/ “limit==100000” This API can be used directly via JS without authentification.

“Select2” is used for searching inside the selectbox. See: https://select2.org/data-sources/ajax

Option-label is the name of the institute and the deqar_id.
Example: “University of Vienna (DEQARINST0784)”
Option-value is the deqar_id (e.g.: DEQARINST0784)

The deqar_id is used for the API transfer. Additionally, the Label is stored in the TYPO3 database for the views.

It is possible to select more than one Institution.

#### Submit
After submitting the form, the required fields are validated (see data models). Also the date formats and conditionally required fields have to be respected.

If no errors, the data will be transferred with the API: https://docs.deqar.eu/data_submission/#submission-api

Additionally the TYPO3 record will be created.

##### API Response
If the call fails (returns an error), a TYPO3 Errorlog-Message will be written. The error-result will be assigned to the view. So it can be handled in the HTML-View if wanted.
If the call is successful, the complete data array is assigned to the HTML-View. So the frontend-developer can handle the whole or needed data for his needs.
The API returns the property “report_id”. This must be stored (updated) to the TYPO3 record.

##### API call
See the official documentation how to use the token: https://docs.deqar.eu/data_submission/#authentication

##### Links
Helpful Links to the official documentation, related to this Extension:
- https://backend.deqar.eu/webapi/v2/swagger/
- https://docs.deqar.eu/web_api/#example-2-cross-border-reports-by-a-specific-agency
- https://backend.deqar.eu/webapi/v2/browse/institutions/?agency=EAEVE
- https://docs.deqar.eu/report_data/ (required fields)
- https://docs.deqar.eu/report_data/#validity

Eter (not needed):
- https://www.eter-project.com/api/doc/#/hei-export/get_hei_export (API for ETER)
- https://www.eqar.eu/qa-results/download-data-sets/?cn-reloaded=1 (Download for ETER)
- https://docs.deqar.eu/report_data/#institutions (API delivers ETER)

## Plugin

### Introduction
The Extension exists of one Plugin. Plugins are to be used in the TYPO3-Frontend.

The TYPO3-Plugin is showing the reports from TYPO3 and DEQAR in the frontend. If a report exists in both systems, the data from TYPO3 is used. It can be included on one or more pages.

### Plugin Settings
The list view shows all records from a given time-range. The time range is configurable in the Plugin-Settings (Flexform). Therefore are two settings:
- load_from (YYYY-MM-DD)
- load_until (YYYY-MM-DD)

If load_from is empty, then no start-date is used. All files from the beginning will be shown.

If load_until is empty, the current day is used. All files until today will be shown.

### List view
The plugin shows a list of all reports of the given time-range. The reports are sorted by:
- decision (1,2,3,4)
- institutions alphabetically
- valid_from

There is no possibility to search, filter, pagination and sort by hand.

The reports are filtered by the extension-setting “agency” (if set).
