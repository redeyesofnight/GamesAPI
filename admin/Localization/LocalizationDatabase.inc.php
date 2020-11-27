<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/CityQuest2/DBConnection.inc.php");
	require_once("KeyTranslation.inc.php");
	require_once("LocalizationModel.inc.php");
	require_once("SupportedLocalesModel.inc.php");

	function GetSupportedLocales()
	{
		$dbc = new DBConnection();
		$sql = "SELECT DISTINCT locale_code FROM localization";
		$result = $dbc->handle->query($sql);
		$slm = new SupportedLocalesModel();
		if($result)
		{
			while($row = $result->fetch_assoc())
			{
				array_push($slm->locale_codes, $row['locale_code']);
			}
		}
		return $slm;
	}

	function GetDistinctKeyCount()
	{
		
	}

	function GetTranslationDatabase($localeCode)
	{
		$keyArray = GetAllKeysForTranslation($localeCode);
		$model = new LocalizationModel();
		$model->db = $keyArray;
		$model->localeCode = $localeCode;
		return $model;
	}

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

	function AddKey($key, $value, $localeCode)
	{
		$dbc = new DBConnection();
		$sql = "INSERT INTO localization (`localize_key`, `value`, `locale_code`) VALUES ('$key', '$value', '$localeCode')";
		$result = $dbc->handle->query($sql);
		$dbc->close();
		return $result != null ? 1 : 0;
	}

	function AddLocale($localeCode)
	{
		AddKey("locale", $localeCode, $localeCode);
	}

	function DeleteKeyAllLang($key)
	{
		$dbc = new DBConnection();
		$sql = "DELETE FROM localization WHERE localize_key = '$key'";
		$result = $dbc->handle->query($sql);
		$dbc->close();
		return $result != null ? 1 : 0;
	}

	function DeleteKey($key, $localeCode)
	{
		$dbc = new DBConnection();
		$sql = "DELETE FROM localization WHERE localize_key = '$key' AND locale_code = '$localeCode'";
		$result = $dbc->handle->query($sql);
		$dbc->close();
		return $result != null ? 1 : 0;
	}

	function DeleteLocale($localeCode)
	{
		$dbc = new DBConnection();
		$sql = "DELETE FROM localization WHERE locale_code = '$localeCode'";
		$result = $dbc->handle->query($sql);
		$dbc->close();
		return $result != null ? 1 : 0;
	}

	
?>