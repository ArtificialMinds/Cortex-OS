# cortex-os
A Linux distribution for the Internet of Things

This repository is not intended for use by Cortex OS home/business users. Instead, it allows developers to build their own version of the OS and enhance functionality.

See contributing below for details on how to be a part of this project.

## Building
This distribution is designed to be built on a Raspberry Pi device or similar. This repository hosts the most minimal bootable Debian-based distribution possible, which will then expand and install itself using Debian's unattended net installer.

The following packages are required on a host machine to build this distribution:

+ `pv` -
	pv  shows the progress of data through a pipeline by giving information
	such as time elapsed, percentage completed (with progress bar), current
	throughput rate, total data transferred, and ETA.
+ `git` -
	Git is a fast, scalable, distributed revision control system with an
	unusually rich command set that provides both high-level operations and
	full access to internals.
+ `curl` -
	curl  is  a tool to transfer data from or to a server, using one of the
	supported protocols (DICT, FILE, FTP, FTPS, GOPHER, HTTP, HTTPS,  IMAP,
	IMAPS,  LDAP,  LDAPS,  POP3, POP3S, RTMP, RTSP, SCP, SFTP, SMTP, SMTPS,
	TELNET and TFTP).  The command is designed to work without user  inter‐
	action.
+ `bzip2` -
	bzip2  compresses  files  using  the Burrows-Wheeler block sorting text
	compression algorithm, and Huffman coding.   Compression  is  generally
	considerably   better   than   that   achieved   by  more  conventional
	LZ77/LZ78-based compressors, and approaches the performance of the  PPM
	family of statistical compressors.
+ `zip` -
	zip  is  a compression and file packaging utility for Unix, VMS, MSDOS,
	OS/2, Windows 9x/NT/XP, Minix, Atari, Macintosh, Amiga, and An  RISC
	OS.   It  is analogous to a combination of the Unix commands tar(1) and
	compress(1) and is compatible with PKZIP (Phil  Katz's  ZIP  for  MSDOS
	systems).
+ `xz-utils` -
	xz is a general-purpose data compression tool with command line  syntax
	similar  to  gzip(1)  and  bzip2(1).  The native file format is the .xz
	format, but the legacy .lzma format used by LZMA  Utils  and  raw  com‐
	pressed streams with no container format headers are also supported.
+ `gnupg` -
	GnuPG is a set of programs for public key encryption and digital signa‐
	tures.  The program most users will want to use is the OpenPGP  command
	line  tool,  named gpg.  gpgv is a stripped down version of gpg with no
	encryption functionality, used only  to  verify  signatures  against  a
	trusted keyring.  There is also a tool called gpgsplit to split OpenPGP
	messages or keyrings into their component packets.  This is mainly use‐
	ful for seeing how OpenPGP messages are put together.
+ `kpartx`
	This  tool,  derived  from util-linux' partx, reads partition tables on
	specified device  and  create  device  maps  over  partitions  segments
	detected. It is called from hotplug upon device maps creation and dele‐
	tion.
+ `dosfstools`
	fsck.fat verifies the consistency of MS-DOS filesystems and  optionally
	tries to repair them.
+ `binutils` -
	The GNU Binary Utilities,  or binutils,  are a set of programming tools
	for creating  and managing  binary programs,  object files,  libraries,
	profile	data,  and assembly source code  originally written  by progra-
	mmers at Cygnus	Solutions.
+ `bc` -
	bc  is a language that supports arbitrary precision numbers with inter‐
	active execution of statements.  There are  some  similarities  in  the
	syntax  to  the  C  programming  language.   A standard math library is
	available by command line option.  If requested, the  math  library  is
	defined before processing any files.  bc starts by processing code from
	all the files listed on the command line in the  order  listed.   After
	all  files  have been processed, bc reads from the standard input.  All
	code is executed as it is read.  (If a file contains a command to  halt
	the processor, bc will never read from the standard input.)

The base netinst scripts are tightly based on [debian-pi/raspbian-ua-netinst][debian-pi]

### Flashing to removal storage
The whole installation is intended to be automated and unattended. Writing to removable storage like an SD card or USB flash drive will **completely format the storage device, losing anything that was present on the device**, so proceed with caution.

Once cloning this repository to your host computer and installing the required packages as described above, run the following as root:

```
./install.sh /path/to/device
```

In turn, the install script performs the following individual actions:

1. `./clean.sh` - removes any downloaded content from previous installations.
2. `./download.sh` - downloads the source packages for building the base image.
3. `./build.sh` - builds the initial RAM file system (initramfs).
4. `./image.sh` - builds the initramfs archive into a raw and compressed disk image.
5. `./flash.sh /path/to/device` - flashes the provided device with the disk image.

At this point, the removable storage device can be booted from the end hardware, which must have an internet connection. The OS will boot into the minimal image, then download and expand itself to the Cortex-OS using the numerical scripts within `/script`.

[debian-pi]: https://github.com/debian-pi/raspbian-ua-netinst

# Scripting the filesystem
Within `filesystem/` are all the scripts required to automate the build of the Cortex OS filesystem. Notable files include:

+ `/etc/udhcpc/default.script` run to configure the very small DHCP server for configuring the Raspberry Pi at boot.
+ `/etc/init.d/rcS` is the script that is run at boot time. It executes the scripts in /etc/init.d/rcS.d/ in alphabetical order.

# Contributing

TODO: Write this.
