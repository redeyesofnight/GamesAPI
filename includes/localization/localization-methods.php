<?php
	include_once("../db.php");
	echo "h1";
	include_once("../models/key-translation-model.php");
	echo "h2";
	include_once("../models/localization-model.php");
	echo "h3";
	include_once("../models/locales-model.php");
	echo "h4";
	include_once("../models/locale-model.php");
	echo "h5";

	function GetLocales()
	{
		$dbc = new DBConnection();
		$sql = "SELECT locale_code, count(locale_code) as keyCount from localization GROUP BY locale_code";
		$result = $dbc->handle->query($sql);
		$locales = null;
		if($result)
		{
			$localesModel = new LocalesModel();
			while($row = $result->fetch_assoc())
			{
				$locale = new LocaleModel($row['locale_code'], $row['keyCount']);
				array_push($localesModel->locales, $locale);
			}
		}
		return $localesModel;
	}
	echo "h6";

	function GetSingleLocale($locale)
	{
		$dbc = new DBConnection();
		$sql = "SELECT locale_code, count(locale_code) as keyCount from localization WHERE locale_code = '$locale' GROUP BY locale_code";
		$result = $dbc->handle->query($sql);
		$locale = null;
		if($result)
		{
			if($row = $result->fetch_assoc())
			{
				$locale = new LocaleModel($row['locale_code'], $row['keyCount']);
			}
		}
		return $locale;
	}
	echo "h7";

	function GetTranslationDatabase($localeCode)
	{
		$keyArray = GetAllKeysForTranslation($localeCode);
		$model = new LocalizationModel();
		$model->db = $keyArray;
		$model->localeCode = $localeCode;
		return $model;
	}

	echo "h8";

	function GetAllKeysForLocale($localeCode)
	{
		$dbc = new DBConnection();
		$sql = "SELECT id, localize_key, value from localization where locale_code = '".$localeCode."'";
		$result = $dbc->handle->query($sql);
		$returnVal = array();
		if($result)
		{
			while($row = $result->fetch_assoc())
			{
				$kt = new KeyTranslation($row["id"],$row["localize_key"], $row["value"]);
				array_push($returnVal, $kt);
			}
			$result->free_result();
		}
		$dbc->close();
		return $returnVal;
	}
	echo "h9";

	function GetKeyCountForLocale($localeCode)
	{
		$dbc = new DBConnection();
		$sql = "SELECT count(id) as count from localization where locale_code = '$localeCode' LIMIT 1";
		$result = $dbc->handle->query($sql);
		if($result)
		{
			if($row = $result->fetch_assoc())
			{
				$count = $row["count"];
				return $count;
			}
			$result->free_result();
		}
		return 0;
	}
	echo "h10";

	function GetLocalizedKey($key, $localeCode)
	{
		$dbc = new DBConnection();
		$sql = "SELECT id, value from localization where localize_key = '".$key."' AND locale_code = '".$localeCode."' LIMIT 1";
		$result = $dbc->handle->query($sql);
		$returnVal = null;
		if($result)
		{
			if($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				$returnVal = new KeyTranslation($row['id'],$key,$row['value']);
			}
			$result->free_result();
		}
		$dbc->close();
		return $returnVal;
	}
	echo "h11";

	function DoesKeyExistAnyLang($key)
	{
		$dbc = new DBConnection();
		$sql = "SELECT count(id) as count from localization where localize_key = '".$key."'";
		$result = $dbc->handle->query($sql);
		$returnVal = 0;
		if($result)
		{
			if($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				$count = $row['count'];
				$returnVal = ($count > 0) ? 1 : 0;
			}
			$result->free_result();
		}
		$dbc->close();
		return $returnVal;
	}
	echo "h12";

	function DoesKeyExist($key, $localeCode)
	{
		$dbc = new DBConnection();
		$sql = "SELECT count(id) as count from localization where localize_key = '".$key."' AND locale_code = '$localeCode'";
		$result = $dbc->handle->query($sql);
		$returnVal = 0;
		if($result)
		{
			if($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				$count = $row['count'];
				$returnVal = ($count > 0) ? 1 : 0;
			}
			$result->free_result();
		}
		$dbc->close();
		return $returnVal;
	}
	echo "h13";

	function DoesLocaleExist($localeCode)
	{
		return DoesKeyExist("locale", $localeCode);
	}
	echo "h14";

	function AddKey($key, $value, $localeCode)
	{
		$dbc = new DBConnection();
		$sql = "INSERT INTO localization (`localize_key`, `value`, `locale_code`) VALUES ('$key', '$value', '$localeCode') ON DUPLICATE KEY UPDATE localization SET value = '$value' WHERE key = '$key' AND locale_code = '$localeCode'";
		$result = $dbc->handle->query($sql);
		$dbc->close();
		return $result != null ? 1 : 0;
	}
	echo "h15";

	function AddLocale($localeCode)
	{
		return AddKey("locale", $localeCode, $localeCode);
	}
	echo "h16";

	function DeleteKeyAllLang($key)
	{
		$dbc = new DBConnection();
		$sql = "DELETE FROM localization WHERE localize_key = '$key'";
		$result = $dbc->handle->query($sql);
		$dbc->close();
		return $result != null ? 1 : 0;
	}
	echo "h17";

	function DeleteKey($key, $localeCode)
	{
		$dbc = new DBConnection();
		$sql = "DELETE FROM localization WHERE localize_key = '$key' AND locale_code = '$localeCode'";
		$result = $dbc->handle->query($sql);
		$dbc->close();
		return $result != null ? 1 : 0;
	}
	echo "h18";

	function DeleteLocale($localeCode)
	{
		$dbc = new DBConnection();
		$sql = "DELETE FROM localization WHERE locale_code = '$localeCode'";
		$result = $dbc->handle->query($sql);
		$dbc->close();
		return $result != null ? 1 : 0;
	}
	echo "h19";

	
?>