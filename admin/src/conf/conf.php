<?php
$ConfigDataVariableExtractedFromDotConfigFile = file_get_contents(__BASE_DIR__ . '.config');
$ConfigDataVariableExtractedFromDotConfigFileArr = (explode(',', $ConfigDataVariableExtractedFromDotConfigFile));
$ConfigDataVariableExtractedFromDotConfigFileDevelopment = str_replace(' ', '', explode(':', $ConfigDataVariableExtractedFromDotConfigFileArr[0])[1]);
$ConfigDataVariableExtractedFromDotConfigFileDebug = str_replace(' ', '', explode(':', $ConfigDataVariableExtractedFromDotConfigFileArr[1])[1]);
$ConfigDataVariableExtractedFromDotConfigFileProd = str_replace('', '', explode(':', $ConfigDataVariableExtractedFromDotConfigFileArr[2])[1]);
$ConfigDataVariableExtractedFromDotConfigFileProjectName = str_replace(' ', '', explode(':', $ConfigDataVariableExtractedFromDotConfigFileArr[3])[1]);
$ConfigDataVariableExtractedFromDotConfigFileDarkMode = str_replace(' ', '', explode(':', $ConfigDataVariableExtractedFromDotConfigFileArr[4])[1]);
$DEVELOPMENT = $ConfigDataVariableExtractedFromDotConfigFileDevelopment == 'true';
$DEBUG = $ConfigDataVariableExtractedFromDotConfigFileDebug == 'true';
$PROD = $ConfigDataVariableExtractedFromDotConfigFileProd == 'true';
$DARK_MODE = $ConfigDataVariableExtractedFromDotConfigFileDarkMode == 'true';
$PROJECT__NAME = $ConfigDataVariableExtractedFromDotConfigFileProjectName != '' ? $ConfigDataVariableExtractedFromDotConfigFileProjectName : 'پروژه';
if (!class_exists('FwConfig')) {
    class FwConfig {
        public static function PROJECT_NAME(){
            $ConfigDataVariableExtractedFromDotConfigFile = file_get_contents(__BASE_DIR__ . '.config');
            $ConfigDataVariableExtractedFromDotConfigFileArr = (explode(',', $ConfigDataVariableExtractedFromDotConfigFile));
            return str_replace('', '', explode(':', $ConfigDataVariableExtractedFromDotConfigFileArr[3])[1]);
        }
        public static function DARK_MODE(){
            $ConfigDataVariableExtractedFromDotConfigFile = file_get_contents(__BASE_DIR__ . '.config');
            $ConfigDataVariableExtractedFromDotConfigFileArr = (explode(',', $ConfigDataVariableExtractedFromDotConfigFile));
            return str_replace(' ', '', explode(':', $ConfigDataVariableExtractedFromDotConfigFileArr[4])[1]);
        }
        public static function PROD(){
            $ConfigDataVariableExtractedFromDotConfigFile = file_get_contents(__BASE_DIR__ . '.config');
            $ConfigDataVariableExtractedFromDotConfigFileArr = (explode(',', $ConfigDataVariableExtractedFromDotConfigFile));
            return trim(str_replace('', '', explode(':', $ConfigDataVariableExtractedFromDotConfigFileArr[2])[1])) == 'true';
        }
        public static function DEBUG(){
            $ConfigDataVariableExtractedFromDotConfigFile = file_get_contents(__BASE_DIR__ . '.config');
            $ConfigDataVariableExtractedFromDotConfigFileArr = (explode(',', $ConfigDataVariableExtractedFromDotConfigFile));
            return trim(str_replace(' ', '', explode(':', $ConfigDataVariableExtractedFromDotConfigFileArr[1])[1])) == 'true';
        }
        public static function DEVELOPMENT(){
            $ConfigDataVariableExtractedFromDotConfigFile = file_get_contents(__BASE_DIR__ . '.config');
            $ConfigDataVariableExtractedFromDotConfigFileArr = (explode(',', $ConfigDataVariableExtractedFromDotConfigFile));
            return trim(str_replace(' ', '', explode(':', $ConfigDataVariableExtractedFromDotConfigFileArr[0])[1])) == 'true';
        }

        public static function API_TOKEN()
        {
            $ConfigDataVariableExtractedFromDotConfigFile = file_get_contents(__BASE_DIR__ . '.config');
            $ConfigDataVariableExtractedFromDotConfigFileArr = (explode(',', $ConfigDataVariableExtractedFromDotConfigFile));
            return str_replace(' ', '', explode(':', $ConfigDataVariableExtractedFromDotConfigFileArr[5])[1]);
        }

        public static function HOST() {
            $ConfigDataVariableExtractedFromDotConfigFile = file_get_contents(__BASE_DIR__ . '.config');
            $ConfigDataVariableExtractedFromDotConfigFileArr = (explode(',', $ConfigDataVariableExtractedFromDotConfigFile));
            return str_replace(' ', '', explode(':', $ConfigDataVariableExtractedFromDotConfigFileArr[6])[1]);
        }

    }
}
$GLOBALS['PROJECT__NAME'] = $PROJECT__NAME;
$GLOBALS['DARK_MODE'] = $DARK_MODE;
$GLOBALS['PROD'] = $PROD;
$GLOBALS['DEBUG'] = $DEBUG;
$GLOBALS['DEVELOPMENT'] = $DEVELOPMENT;
