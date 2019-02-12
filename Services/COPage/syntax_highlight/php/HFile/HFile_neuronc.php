<?php
$BEAUT_PATH = realpath(".")."/Services/COPage/syntax_highlight/php";
if (!isset ($BEAUT_PATH)) return;
require_once("$BEAUT_PATH/Beautifier/HFile.php");
  class HFile_neuronc extends HFile{
   function HFile_neuronc(){
     $this->HFile();	
/*************************************/
// Beautifier Highlighting Configuration File 
// Neuron C
/*************************************/
// Flags

$this->nocase            	= "0";
$this->notrim            	= "0";
$this->perl              	= "0";

// Colours

$this->colours        	= array("blue", "purple", "gray", "brown", "blue");
$this->quotecolour       	= "blue";
$this->blockcommentcolour	= "green";
$this->linecommentcolour 	= "green";

// Indent Strings

$this->indent            	= array("{");
$this->unindent          	= array("}");

// String characters and delimiters

$this->stringchars       	= array("\"", "'");
$this->delimiters        	= array("~", "!", "@", "%", "^", "&", "*", "(", ")", "-", "+", "=", "|", "\\", "/", "{", "}", "[", "]", ":", ";", "\"", "'", "<", ">", " ", ",", "	", ".", "?");
$this->escchar           	= "";

// Comment settings

$this->linecommenton     	= array("//");
$this->blockcommenton    	= array("/*");
$this->blockcommentoff   	= array("*/");

// Keywords (keyword mapping to colour number)

$this->keywords          	= array(
			"used" => "", 
			"in" => "", 
			"programming" => "", 
			"embedded" => "", 
			"Neuron" => "", 
			"(MC3150,3120)" => "", 
			"chips" => "", 
			"for" => "1", 
			"distributed" => "", 
			"control" => "", 
			"applications" => "", 
			"auto" => "1", 
			"break" => "1", 
			"case" => "1", 
			"char" => "1", 
			"const" => "1", 
			"continue" => "1", 
			"default" => "1", 
			"do" => "1", 
			"double" => "1", 
			"else" => "1", 
			"enum" => "1", 
			"extern" => "1", 
			"float" => "1", 
			"float_type" => "1", 
			"goto" => "1", 
			"if" => "1", 
			"int" => "1", 
			"long" => "1", 
			"msg_tag" => "1", 
			"mtimer" => "1", 
			"network" => "1", 
			"quad" => "1", 
			"register" => "1", 
			"return" => "1", 
			"short" => "1", 
			"signed" => "1", 
			"sizeof" => "1", 
			"static" => "1", 
			"stimer" => "1", 
			"struct" => "1", 
			"switch" => "1", 
			"s32_type" => "1", 
			"typedef" => "1", 
			"union" => "1", 
			"unsigned" => "1", 
			"void" => "1", 
			"volatile" => "1", 
			"when" => "1", 
			"while" => "1", 
			"#define" => "1", 
			"#error" => "1", 
			"#include" => "1", 
			"#elif" => "1", 
			"#if" => "1", 
			"#line" => "1", 
			"#else" => "1", 
			"#ifdef" => "1", 
			"#pragma" => "1", 
			"#endif" => "1", 
			"#ifndef" => "1", 
			"#undef" => "1", 
			"addr_table_index" => "2", 
			"bcd2bin" => "2", 
			"bin2bcd" => "2", 
			"eeprom_memcpy" => "2", 
			"flush_completes" => "2", 
			"get_tick_count" => "2", 
			"high_byte" => "2", 
			"io_changes" => "2", 
			"io_change_init" => "2", 
			"io_in" => "2", 
			"io_in_ready" => "2", 
			"io_in_request" => "2", 
			"io_out" => "2", 
			"io_out_ready" => "2", 
			"io_out_request" => "2", 
			"io_preserve_input" => "2", 
			"io_select" => "2", 
			"io_set_clock" => "2", 
			"io_set_direction" => "2", 
			"io_update_occurs" => "2", 
			"is_bound" => "2", 
			"low_byte" => "2", 
			"make_long" => "2", 
			"msg_alloc" => "2", 
			"msg_alloc_priority" => "2", 
			"msg_cancel" => "2", 
			"msg_completes" => "2", 
			"msg_fails" => "2", 
			"msg_free" => "2", 
			"msg_receive" => "2", 
			"msg_send" => "2", 
			"msg_succeeds" => "2", 
			"nv_table_index" => "2", 
			"poll" => "2", 
			"propagate" => "2", 
			"reset" => "2", 
			"resp_alloc" => "2", 
			"resp_arrives" => "2", 
			"resp_cancel" => "2", 
			"resp_free" => "2", 
			"resp_receive" => "2", 
			"resp_send" => "2", 
			"sleep" => "2", 
			"swap_bytes" => "2", 
			"timer_expires" => "2", 
			"touch_bit" => "2", 
			"touch_byte" => "2", 
			"touch_first" => "2", 
			"touch_next" => "2", 
			"touch_reset" => "2", 
			"wink" => "2", 
			"ackd" => "3", 
			"activate_service_led" => "3", 
			"auth" => "3", 
			"authenticated" => "3", 
			"baud" => "3", 
			"bind" => "3", 
			"bit" => "3", 
			"bitshift" => "3", 
			"byte" => "3", 
			"clock" => "3", 
			"clockedge" => "3", 
			"config" => "3", 
			"config_data" => "3", 
			"ded" => "3", 
			"dualslope" => "3", 
			"eeprom" => "3", 
			"edgedivide" => "3", 
			"edgelog" => "3", 
			"far" => "3", 
			"fastaccess" => "3", 
			"frequency" => "3", 
			"infrared" => "3", 
			"input" => "3", 
			"input_is_new" => "3", 
			"input_value" => "3", 
			"invert" => "3", 
			"i2c" => "3", 
			"IO_0" => "3", 
			"IO_1" => "3", 
			"IO_2" => "3", 
			"IO_3" => "3", 
			"IO_4" => "3", 
			"IO_5" => "3", 
			"IO_6" => "3", 
			"IO_7" => "3", 
			"IO_8" => "3", 
			"IO_9" => "3", 
			"kbaud" => "3", 
			"leveldetect" => "3", 
			"magcard" => "3", 
			"magtrack1" => "3", 
			"master" => "3", 
			"max_rate_est" => "3", 
			"msg_arrives" => "3", 
			"msg_in" => "3", 
			"msg_out" => "3", 
			"msg_tag_index" => "3", 
			"mux" => "3", 
			"muxbus" => "3", 
			"neurowire" => "3", 
			"nibble" => "3", 
			"nonbind" => "3", 
			"nonconfig" => "3", 
			"nonpriority" => "3", 
			"numbits" => "3", 
			"nv_array_index" => "3", 
			"nv_in_addr" => "3", 
			"nv_in_index" => "3", 
			"offchip" => "3", 
			"offline" => "3", 
			"onchip" => "3", 
			"oneshot" => "3", 
			"output" => "3", 
			"parallel" => "3", 
			"period" => "3", 
			"polled" => "3", 
			"priority" => "3", 
			"pulsecount" => "3", 
			"pulsewidth" => "3", 
			"quadrature" => "3", 
			"ram" => "3", 
			"rate_est" => "3", 
			"read_only_data" => "3", 
			"read_only_data2" => "3", 
			"resp_in" => "3", 
			"resp_out" => "3", 
			"select" => "3", 
			"serial" => "3", 
			"slave" => "3", 
			"slave_b" => "3", 
			"sync" => "3", 
			"synchronized" => "3", 
			"system" => "3", 
			"totalcount" => "3", 
			"touch" => "3", 
			"triac" => "3", 
			"triggeredcount" => "3", 
			"unackd" => "3", 
			"unackd_rpt" => "3", 
			"uninit" => "3", 
			"wiegand" => "3", 
			"SNVT_address" => "4", 
			"SNVT_alarm" => "4", 
			"SNVT_amp" => "4", 
			"SNVT_amp_f" => "4", 
			"SNVT_amp_mil" => "4", 
			"SNVT_angle" => "4", 
			"SNVT_angle_deg" => "4", 
			"SNVT_angle_f" => "4", 
			"SNVT_angle_vel" => "4", 
			"SNVT_angle_vel_f" => "4", 
			"SNVT_area" => "4", 
			"SNVT_btu_f" => "4", 
			"SNVT_btu_kilo" => "4", 
			"SNVT_btu_mega" => "4", 
			"SNVT_char_ascii" => "4", 
			"SNVT_chlr_status" => "4", 
			"SNVT_color" => "4", 
			"SNVT_config_src" => "4", 
			"SNVT_count" => "4", 
			"SNVT_count_f" => "4", 
			"SNVT_count_inc" => "4", 
			"SNVT_count_inc_f" => "4", 
			"SNVT_currency" => "4", 
			"SNVT_date_cal" => "4", 
			"SNVT_date_day" => "4", 
			"SNVT_date_time" => "4", 
			"SNVT_defr_mode" => "4", 
			"SNVT_defr_state" => "4", 
			"SNVT_term" => "4", 
			"SNVT_density" => "4", 
			"SNVT_density_f" => "4", 
			"SNVT_earth_pos" => "4", 
			"SNVT_elapsed_tm" => "4", 
			"SNVT_elec_kwhr" => "4", 
			"SNVT_elec_whr" => "4", 
			"SNVT_elec_whr_f" => "4", 
			"SNVT_evap_state" => "4", 
			"SNVT_file_pos" => "4", 
			"SNVT_file_req" => "4", 
			"SNVT_file_status" => "4", 
			"SNVT_fire_indcte" => "4", 
			"SNVT_fire_init" => "4", 
			"SNVT_fire_test" => "4", 
			"SNVT_flow" => "4", 
			"SNVT_flow_f" => "4", 
			"SNVT_flow_mil" => "4", 
			"SNVT_freq_f" => "4", 
			"SNVT_freq_hz" => "4", 
			"SNVT_freq_kilohz" => "4", 
			"SNVT_freq_milhz" => "4", 
			"SNVT_grammage" => "4", 
			"SNVT_grammage_f" => "4", 
			"SNVT_hvac_emerg" => "4", 
			"SNVT_hvac_mode" => "4", 
			"SNVT_hvac_overid" => "4", 
			"SNVT_hvac_status" => "4", 
			"SNVT_ISO_7811" => "4", 
			"SNVT_length" => "4", 
			"SNVT_length_f" => "4", 
			"SNVT_length_kilo" => "4", 
			"SNVT_length_micr" => "4", 
			"SNVT_length_mil" => "4", 
			"SNVT_lev_cont" => "4", 
			"SNVT_lev_cont_f" => "4", 
			"SNVT_lev_disc" => "4", 
			"SNVT_lev_percent" => "4", 
			"SNVT_lux" => "4", 
			"SNVT_magcard" => "4", 
			"SNVT_mass" => "4", 
			"SNVT_mass_f" => "4", 
			"SNVT_mass_kilo" => "4", 
			"SNVT_mass_mega" => "4", 
			"SNVT_mass_mil" => "4", 
			"SNVT_muldiv" => "4", 
			"SNVT_multiplier" => "4", 
			"SNVT_obj_request" => "4", 
			"SNVT_obj_status" => "4", 
			"SNVT_occupancy" => "4", 
			"SNVT_override" => "4", 
			"SNVT_ph" => "4", 
			"SNVT_ph_f" => "4", 
			"SNVT_power" => "4", 
			"SNVT_power_f" => "4", 
			"SNVT_power_kilo" => "4", 
			"SNVT_ppm" => "4", 
			"SNVT_ppm_f" => "4", 
			"SNVT_preset" => "4", 
			"SNVT_press" => "4", 
			"SNVT_press_f" => "4", 
			"SNVT_press_p" => "4", 
			"SNVT_pwr_fact" => "4", 
			"SNVT_pwr_fact_f" => "4", 
			"SNVT_res" => "4", 
			"SNVT_res_f" => "4", 
			"SNVT_res_kilo" => "4", 
			"SNVT_rpm" => "4", 
			"SNVT_scene" => "4", 
			"SNVT_scene_cfg" => "4", 
			"SNVT_setting" => "4", 
			"SNVT_smo_ocscur" => "4", 
			"SNVT_sound_db" => "4", 
			"SNVT_sound_db_f" => "4", 
			"SNVT_speed" => "4", 
			"SNVT_speed_f" => "4", 
			"SNVT_speed_mil" => "4", 
			"SNVT_state" => "4", 
			"SNVT_str_asc" => "4", 
			"SNVT_str_int" => "4", 
			"SNVT_switch" => "4", 
			"SNVT_telcom" => "4", 
			"SNVT_temp" => "4", 
			"SNVT_temp_f" => "4", 
			"SNVT_temp_p" => "4", 
			"SNVT_temp_ror" => "4", 
			"SNVT_temp_setpt" => "4", 
			"SNVT_therm_mode" => "4", 
			"SNVT_time_f" => "4", 
			"SNVT_time_hour" => "4", 
			"SNVT_time_min" => "4", 
			"SNVT_time_passed" => "4", 
			"SNVT_time_sec" => "4", 
			"SNVT_time_stamp" => "4", 
			"SNVT_time_zone" => "4", 
			"SNVT_tod_event" => "4", 
			"SNVT_trans_table" => "4", 
			"SNVT_vol" => "4", 
			"SNVT_vol_f" => "4", 
			"SNVT_vol_kilo" => "4", 
			"SNVT_vol_mil" => "4", 
			"SNVT_volt" => "4", 
			"SNVT_volt_dbmv" => "4", 
			"SNVT_volt_f" => "4", 
			"SNVT_volt_kilo" => "4", 
			"SNVT_volt_mil" => "4", 
			"SNVT_zerospan" => "4", 
			"alarm_type_t" => "5", 
			"calendar_type_t" => "5", 
			"chiller_t" => "5", 
			"config_source_t" => "5", 
			"currency_t" => "5", 
			"days_of_week_t" => "5", 
			"defrost_mode_t" => "5", 
			"defrost_state_t" => "5", 
			"defrost_term_t" => "5", 
			"discrete_levels_t" => "5", 
			"emerg_t" => "5", 
			"evap_t" => "5", 
			"file_request_t" => "5", 
			"file_status_t" => "5", 
			"fire_indicator_t" => "5", 
			"fire_init_t" => "5", 
			"fire_test_t" => "5", 
			"hvac_override_t" => "5", 
			"hvac_t" => "5", 
			"interp_t" => "5", 
			"learn_mode_t" => "5", 
			"object_request_t" => "5", 
			"occup_t" => "5", 
			"override_t" => "5", 
			"priority_level_t" => "5", 
			"scene_config_t" => "5", 
			"scene_t" => "5", 
			"setting_t" => "5", 
			"telcom_states_t" => "5", 
			"therm_mode_t" => "5");

// Special extensions

// Each category can specify a PHP function that returns an altered
// version of the keyword.
        
        

$this->linkscripts    	= array(
			"" => "donothing", 
			"1" => "donothing", 
			"2" => "donothing", 
			"3" => "donothing", 
			"4" => "donothing", 
			"5" => "donothing");
}


function donothing($keywordin)
{
	return $keywordin;
}

}?>