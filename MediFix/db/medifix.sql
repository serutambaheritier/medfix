SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `medifix` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `medifix`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admin` (`id`, `fullname`, `phone`, `username`, `password`) VALUES
(2, 'NSENGIYUMVA', '0785501115', 'admin@gmail.com', '123');

CREATE TABLE `dataset` (
  `id` int(11) NOT NULL,
  `issue` text NOT NULL,
  `cause` text NOT NULL,
  `solution` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `dataset` (`id`, `issue`, `cause`, `solution`) VALUES
(1, 'Failure to deliver anesthetic gas', 'Faulty vaporizer, empty gas cylinder, or system leak', 'Check vaporizer settings, refill gas cylinder, and inspect for leaks'),
(2, 'Hypoxia alarm activation', 'Low oxygen supply or malfunctioning sensor', 'Verify oxygen supply, recalibrate or replace sensor'),
(3, 'Inaccurate anesthetic concentration', 'Malfunctioning vaporizer or improper calibration', 'Calibrate vaporizer, replace if necessary'),
(4, 'Breathing circuit disconnect', 'Loose or improperly connected hoses', 'Inspect and secure connections, replace damaged hoses'),
(5, 'Excessive breathing circuit pressure', 'Blocked expiratory valve or flow rate too high', 'Clear blockage, adjust flow rate, replace valve if faulty'),
(6, 'Mechanical ventilator failure', 'Electrical or pneumatic failure', 'Check power supply, inspect internal components, contact technical support'),
(7, 'CO2 absorbent exhaustion', 'Exhausted CO2 absorbent material', 'Replace CO2 absorbent canister'),
(8, 'Anesthesia machine not powering on', 'Power supply issues or internal circuitry fault', 'Verify power source, check fuses, inspect internal wiring'),
(9, 'Faulty oxygen sensor', 'Sensor degradation or contamination', 'Clean or replace oxygen sensor'),
(10, 'Alarm system malfunction', 'Software glitches or hardware failure', 'Reset system, update software, contact manufacturer support'),
(11, 'Condensation in breathing circuit', 'Excessive moisture in the circuit', 'Drain moisture from the circuit, use heated circuits or moisture traps'),
(12, 'Anesthetic agent leakage', 'Leaks in vaporizer or circuit', 'Inspect and repair leaks, replace faulty components'),
(13, 'Inconsistent tidal volume delivery', 'Malfunctioning ventilator or incorrect settings', 'Recalibrate ventilator, adjust settings, replace faulty components'),
(14, 'Faulty nitrous oxide delivery', 'Blocked or malfunctioning nitrous oxide flowmeter', 'Inspect and clean flowmeter, replace if necessary'),
(15, 'Excessive noise from ventilator', 'Mechanical wear, loose components, or malfunction', 'Inspect for mechanical issues, tighten components, contact technical support'),
(16, 'Patient circuit occlusion', 'Blocked or kinked patient circuit', 'Inspect and clear blockages, replace kinked tubing'),
(17, 'Low battery warning during operation', 'Battery depletion or charging system failure', 'Recharge or replace battery, inspect charging system'),
(18, 'Inaccurate pressure readings', 'Faulty pressure transducer or calibration issues', 'Calibrate or replace pressure transducer'),
(19, 'Gas analyzer failure', 'Sensor contamination or electronic malfunction', 'Clean sensor, recalibrate or replace analyzer'),
(20, 'Broken or cracked flowmeter tube', 'Physical damage to the flowmeter', 'Replace the damaged flowmeter tube'),
(21, 'Sudden drop in oxygen saturation', 'Disconnection or blockage in oxygen supply', 'Reconnect or clear blockage, ensure stable oxygen supply'),
(22, 'Loss of power during operation', 'Power supply failure or battery depletion', 'Check main power supply, replace or recharge battery'),
(23, 'Vaporizer malfunction', 'Internal mechanical issues or improper maintenance', 'Inspect and service the vaporizer, replace if necessary'),
(24, 'Oxygen flush valve sticking', 'Mechanical wear or contamination', 'Clean or replace the flush valve'),
(25, 'Erratic gas flow', 'Obstructions in gas flow paths or faulty flow control valve', 'Clear obstructions, replace faulty valves'),
(26, 'Water trap overflow', 'Excessive condensation or blockage in the water trap', 'Empty water trap regularly, ensure proper drainage'),
(27, 'Gas scavenging system malfunction', 'Blocked or disconnected scavenging lines', 'Inspect and clear blockages, reconnect lines'),
(28, 'Patient hypoventilation', 'Ventilator settings too low or circuit leak', 'Adjust ventilator settings, inspect circuit for leaks'),
(29, 'Faulty anesthetic agent monitoring', 'Sensor contamination or electronic failure', 'Clean or replace sensor, recalibrate monitoring system'),
(30, 'Rapid depletion of anesthetic agent', 'Excessive flow rates or vaporizer malfunction', 'Adjust flow rates, inspect vaporizer for leaks'),
(31, 'Ventilator unable to reach set pressure', 'Leak in breathing circuit or ventilator malfunction', 'Inspect circuit for leaks, recalibrate ventilator, replace faulty components'),
(32, 'High airway pressure alarm', 'Blockage in patient circuit or inappropriate ventilator settings', 'Clear blockages, adjust ventilator settings, replace faulty components'),
(33, 'Anesthetic gas odor in the room', 'Leaks in anesthesia machine or scavenging system', 'Inspect and repair leaks, ensure scavenging system is functional'),
(34, 'Ventilator auto-cycling', 'Faulty trigger sensitivity settings or malfunctioning sensors', 'Adjust trigger settings, recalibrate or replace sensors'),
(35, 'Low inspiratory flow alarm', 'Flow obstruction or ventilator malfunction', 'Clear obstructions, recalibrate or service ventilator'),
(36, 'Patient desaturation', 'Inadequate oxygen delivery or patient condition', 'Ensure adequate oxygen delivery, assess patient condition, adjust ventilator settings'),
(37, 'Slow response of CO2 absorber', 'Degraded absorbent material or excessive moisture', 'Replace CO2 absorbent material, ensure circuit is dry'),
(38, 'Incorrect gas mixture delivered', 'Flow control malfunction or incorrect gas supply connections', 'Inspect and correct flow control settings, verify gas supply connections'),
(39, 'Suction system failure', 'Blockage in suction lines or pump malfunction', 'Clear blockages, inspect and service pump'),
(40, 'Unstable respiratory rate', 'Ventilator settings incorrect or patient condition', 'Adjust ventilator settings, monitor patient condition'),
(41, 'Unresponsive control panel', 'Software glitch or electronic malfunction', 'Reset control panel, update software, or contact technical support'),
(42, 'Incorrect tidal volume readings', 'Calibration issues or sensor malfunction', 'Recalibrate sensors, replace if necessary'),
(43, 'Failure to reach desired inspiratory pressure', 'Ventilator malfunction or leakage in breathing circuit', 'Recalibrate ventilator, inspect circuit for leaks'),
(44, 'Difficulty in ventilator weaning', 'Ventilator settings too aggressive or patient condition', 'Gradually adjust ventilator settings, assess patient readiness for weaning'),
(45, 'Leaky anesthetic circuit', 'Worn out or damaged components in the circuit', 'Inspect and replace damaged components, ensure tight connections'),
(46, 'Excessive CO2 levels in breathing circuit', 'Exhausted CO2 absorbent or inadequate ventilation', 'Replace CO2 absorbent material, increase ventilation'),
(47, 'Breathing circuit not holding pressure', 'Leak in circuit components or faulty pressure valves', 'Inspect and replace leaking components, check pressure valve function'),
(48, 'Ventilator overheating', 'Mechanical stress or electrical fault', 'Inspect and service ventilator, ensure adequate cooling'),
(49, 'Condensation in gas sampling lines', 'Excessive moisture or inadequate line insulation', 'Use heated sampling lines, regularly drain moisture'),
(50, 'Noise from anesthesia machine', 'Mechanical wear or loose components', 'Inspect and tighten components, service mechanical parts'),
(51, 'Electrical short circuit', 'Faulty wiring or moisture ingress', 'Inspect and repair wiring, ensure system is dry'),
(52, 'Low nitrous oxide pressure', 'Depleted nitrous oxide cylinder or regulator malfunction', 'Replace or refill cylinder, inspect and service regulator'),
(53, 'Incorrect oxygen concentration displayed', 'Sensor degradation or calibration issues', 'Recalibrate oxygen sensor, replace if necessary'),
(54, 'Expiratory valve sticking', 'Mechanical wear or contamination', 'Clean or replace expiratory valve'),
(55, 'Low compliance of patient circuit', 'Stiff or kinked tubing, or circuit obstructions', 'Inspect and replace stiff or kinked tubing, clear obstructions'),
(56, 'Vaporizer difficult to turn on/off', 'Mechanical wear or misalignment in the control knob', 'Inspect and service vaporizer, replace control knob if necessary'),
(57, 'Low oxygen flush flow', 'Blockage or regulator malfunction', 'Clear blockage, inspect and service regulator'),
(58, 'Excessive dust in machine filters', 'Poor air quality or inadequate maintenance', 'Replace or clean filters regularly, ensure operating room air quality is good'),
(59, 'Unstable gas flow', 'Flow control valve malfunction or fluctuating gas supply', 'Inspect and replace faulty flow control valve, ensure stable gas supply'),
(60, 'Low minute ventilation', 'Inadequate ventilator settings or patient circuit leak', 'Adjust ventilator settings, inspect circuit for leaks'),
(61, 'Loud alarm sound', 'Faulty alarm system or incorrect settings', 'Adjust alarm volume settings, inspect and service alarm system'),
(62, 'Disconnection of gas delivery hose', 'Loose or improperly connected gas delivery hose', 'Inspect and secure connections, replace damaged hoses'),
(63, 'Oxygen tank depleting too quickly', 'High flow rates or leak in the system', 'Adjust flow rates, inspect system for leaks'),
(64, 'Poor visibility of display screen', 'Screen degradation or low contrast settings', 'Adjust screen settings, replace screen if degraded'),
(65, 'Overheating of gas analyzer', 'Mechanical stress or electronic malfunction', 'Inspect and service gas analyzer, ensure adequate cooling'),
(66, 'Low inspiratory pressure alarm', 'Inadequate flow rate or circuit leak', 'Increase flow rate, inspect circuit for leaks'),
(67, 'Inconsistent respiratory rate', 'Patient condition or ventilator settings', 'Adjust ventilator settings, monitor patient closely'),
(68, 'Error in vaporizer settings', 'User error or mechanical malfunction', 'Double-check settings, recalibrate or service vaporizer'),
(69, 'Disconnection of oxygen hose', 'Loose or improperly connected oxygen hose', 'Inspect and secure connections, replace damaged hoses'),
(70, 'Incorrect inspiratory/expiratory ratio', 'Ventilator settings incorrect or malfunctioning', 'Adjust ventilator settings, recalibrate if necessary'),
(71, 'Breathing circuit contamination', 'Poor maintenance or inadequate sterilization practices', 'Regularly sterilize breathing circuit components, replace disposable parts'),
(72, 'Noisy suction system', 'Mechanical wear or blockage in the suction system', 'Inspect and service suction system, clear any blockages'),
(73, 'Delay in anesthesia machine startup', 'Software or hardware initialization issues', 'Update software, inspect internal components, contact technical support'),
(74, 'Excessive anesthetic agent consumption', 'High flow rates or vaporizer malfunction', 'Adjust flow rates, inspect vaporizer for leaks or malfunctions'),
(75, 'Faulty CO2 monitoring', 'Sensor contamination or calibration issues', 'Clean or replace CO2 sensor, recalibrate monitoring system'),
(76, 'Sudden patient movement', 'Inadequate anesthesia depth or malfunctioning delivery system', 'Increase anesthesia depth, inspect delivery system for issues'),
(77, 'Unstable oxygen delivery', 'Fluctuating gas supply or flow control issues', 'Ensure stable gas supply, inspect and service flow control system'),
(78, 'Expired gas cylinder', 'Using expired or near-empty gas cylinder', 'Replace gas cylinder, check expiration dates regularly'),
(79, 'Circuit component disconnection during transport', 'Improper securing of components before transport', 'Secure all components properly before transport, use transport cases if available'),
(80, 'Faulty manual ventilation mode', 'Mechanical wear or malfunction in manual ventilation controls', 'Inspect and service manual ventilation controls, replace faulty components'),
(81, 'Software update failure', 'Incompatible software version or network issues', 'Verify software compatibility, check network connection, retry update'),
(82, 'Oxygen concentrator failure', 'Mechanical wear or electrical fault in the concentrator', 'Inspect and service oxygen concentrator, replace faulty components'),
(83, 'Blockage in gas scavenging line', 'Debris or condensate buildup in scavenging line', 'Clear blockage, regularly inspect and maintain scavenging lines'),
(84, 'Difficulty in securing airway', 'Patient anatomy or equipment issues', 'Use alternative airway management techniques, ensure equipment is properly sized and functioning'),
(85, 'Power supply fluctuations', 'Unstable electrical supply or power surge', 'Use a voltage stabilizer or UPS, inspect power supply connections'),
(86, 'Low flow alarm not activating', 'Faulty alarm system or sensor malfunction', 'Inspect and service alarm system, replace faulty sensors'),
(87, 'Irregular breathing pattern detected', 'Patient condition or ventilator malfunction', 'Monitor patient closely, adjust ventilator settings, service ventilator if necessary'),
(88, 'Anesthesia machine not shutting down', 'Software glitch or mechanical issue', 'Perform a forced shutdown, reset or update software, contact technical support if issue persists'),
(89, 'Calibration failure', 'Sensor degradation or incorrect calibration process', 'Recalibrate sensors according to manufacturer guidelines, replace degraded sensors if necessary'),
(90, 'Broken control knob', 'Physical damage due to wear and tear', 'Replace the control knob, inspect for underlying issues causing damage'),
(91, 'Faulty end-tidal CO2 monitoring', 'Sensor contamination or calibration issues', 'Clean or replace the end-tidal CO2 sensor, recalibrate monitoring system'),
(92, 'Circuit overheating', 'High ambient temperature or mechanical stress', 'Ensure adequate ventilation around the machine, service mechanical components if overheating continues'),
(93, 'Excessive anesthesia depth', 'Incorrect vaporizer settings or user error', 'Adjust vaporizer settings to appropriate levels, monitor patient closely'),
(94, 'Inconsistent inspiratory time', 'Ventilator settings incorrect or patient condition', 'Adjust ventilator settings, monitor patient for changes in condition'),
(95, 'Oxygen concentrator overheating', 'Blocked airflow or mechanical malfunction in the concentrator', 'Ensure proper airflow around the concentrator, service or replace faulty components'),
(96, 'Circuit contamination during procedure', 'Breach in sterile technique or improper handling of circuit components', 'Follow strict sterile technique protocols, replace contaminated components immediately'),
(97, 'Incorrect alarm limits set', 'User error or default settings not adjusted for specific case', 'Double-check and adjust alarm limits based on patient and procedure requirements'),
(98, 'Expired calibration gas', 'Calibration gas expired or not stored properly', 'Replace with new calibration gas, ensure proper storage conditions'),
(99, 'Blocked exhaust port', 'Debris or obstruction in exhaust port', 'Clear blockage, regularly inspect and maintain exhaust ports'),
(100, 'Software incompatibility with peripherals', 'New peripheral devices not compatible with current software', 'Update software to ensure compatibility, contact manufacturer support for guidance');

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `specification` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `doctors` (`id`, `fullname`, `specification`, `email`, `phone`, `password`, `deleted`) VALUES
(1, 'IHUMURIZA  Gaella', 'Surgeon', 'ihumuriza@gmail.com', '0780471000', '456', 0);

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `equipment` varchar(1000) NOT NULL,
  `givenby` int(11) NOT NULL,
  `airef` int(11) NOT NULL,
  `info` mediumtext NOT NULL,
  `tech` mediumtext DEFAULT NULL,
  `recdt` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `jobs` (`id`, `code`, `equipment`, `givenby`, `airef`, `info`, `tech`, `recdt`, `status`) VALUES
(1, 'MediFix-1752156242', '0011', 1, 0, 'Machine making noise during operation', '1752157341', '1752156242', 2);

CREATE TABLE `jobsdone` (
  `id` varchar(100) NOT NULL,
  `problem` mediumtext NOT NULL,
  `action` mediumtext NOT NULL,
  `spare` varchar(1000) NOT NULL,
  `timespent` varchar(100) NOT NULL,
  `tech` int(11) NOT NULL,
  `recdt` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `jobsdone` (`id`, `problem`, `action`, `spare`, `timespent`, `tech`, `recdt`) VALUES
('1752157341', 'machine making noise', 'I solved the problem', 'screws', '2 hrs', 1, '1752157341');

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `idcard` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `idcard`, `fullname`, `email`, `phone`, `password`, `deleted`) VALUES
(1, '123456', 'Roger', 'melchiroger@gmail.com', '0788620994', '123', 0);

ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `dataset`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `jobsdone`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
